const token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token
    }
})

$(document).ready(function (){
    $("#loginBtn").click(login);
    $("#izvrsiSmer").click(dodajSmer);
    $("#izvrsiPredmet").click(dodajPredmet);
    $("#smerOdeljenje").change(filterPredmet);
    $("#dodajOdeljenje").click(dodajOdeljenje);
    $(".datum").click(dohvatiCasove);
    $("#upisiBtn").click(upisiCas);
    $("#btnOcena").click(oceni);
    $("#zahtev").click(zahtev);
    $("#btnZakljuci").click(zakljuciOcenu);
    $("#registrujRoditelj").click(dodajKontakt);
    $("#ucenikRoditelj").change(roditelj);
    $("#predmetiR").change(dohvatiOceneRoditelj);
    $("#filterDatum").click(filterDatum);
    $(".page-link").click(loadMore);

    if(window.location.href == baseUrl + "/home"){
        dohvatiIzostankeDirektor();
    }

    if(window.location.href == baseUrl + "/roditelj"){
        r();
    }

    for(let i=0; i<1000; i++){
        if(window.location.href == baseUrl + `/ucenik/${i}`){
            if(document.getElementById("predmetOcena") != null){
                if(document.getElementById("predmetOcena").value == "0"){
                    $(".izaberitePredmet").show();
                    $(".polugodista").removeClass('d-flex');
                    $(".prosek").removeClass('d-flex');
                    $("#zakljucneUcenik").removeClass('d-flex');
                    $("#zakljucnaNaslov").addClass('sakrij');
                    $(".polugodista").hide();
                    $(".prosek").hide();
                    $("#zakljucneUcenik").hide();

                    $("#predmetOcena").change(dohvatiOcene);
                }
                else {
                    $(".izaberitePredmet").hide();
                    $("#predmetOcena").change(dohvatiOcene);
                }
            }
        }
    }

    $("#formaLozinka").hide();
    $("#izmeniLozinku").click(function (e){
        e.preventDefault();
       $("#formaLozinka").slideToggle();
    });

    $("#formaSmer").hide();
    $("#dodajSmer").click(function (e){
        e.preventDefault();
        $("#formaSmer").slideToggle();
    });

    $("#formaPredmet").hide();
    $("#dodajPredmet").click(function (e){
        e.preventDefault();
        $("#formaPredmet").slideToggle();
    });

    $('.predmeti').hide();
    $('.informacije').hide();

    linkovi('.linkPredmeti', '.predmeti', '.ocene', '.informacije');
    linkovi('.linkInfo', '.informacije', '.ocene', '.predmeti');
    linkovi('.linkOcene', '.ocene', '.predmeti', '.informacije');

    $(".ucenikOdeljenje").hover(function (){
        $(this).addClass('shadow-lg')
    }, function (){
        $(this).removeClass('shadow-lg')
    })

    $('#btnModal').modal();
})

function linkovi(id, prikazi, sakrij1, sakrij2){
    $(id).click(function (e){
        e.preventDefault();
        $(prikazi).show();
        $(sakrij1).hide();
        $(sakrij2).hide();
        $('.linkTab').removeClass('active');
        $(this).addClass('active');

        if(id == ".linkInfo"){
            $(".btnDodajKontakt").parent().removeClass('sakrij');
            $(".prikaziVladanje").addClass('sakrij');
            $("#prikaziZahtev").addClass('sakrij');
            $("#prikaziOcenu").addClass('sakrij');
            $("#prikaziZakljucnu").addClass('sakrij');
            $(".tekstVladanje").addClass('sakrij');
            $(".ocenaVladanje").addClass('sakrij');
        }
        else if(id == ".linkOcene"){
            $(".prikaziVladanje").removeClass('sakrij');
            $("#prikaziZahtev").removeClass('sakrij');
            $(".btnDodajKontakt").parent().addClass('sakrij');
            $("#prikaziOcenu").removeClass('sakrij');
            $("#prikaziZakljucnu").removeClass('sakrij');
            $(".tekstVladanje").removeClass('sakrij');
            $(".ocenaVladanje").removeClass('sakrij');
        }
        else {
            $(".prikaziVladanje").addClass('sakrij');
            $("#prikaziZahtev").addClass('sakrij');
            $(".btnDodajKontakt").parent().addClass('sakrij');
            $("#prikaziOcenu").addClass('sakrij');
            $("#prikaziZakljucnu").addClass('sakrij');
            $(".tekstVladanje").addClass('sakrij');
            $(".ocenaVladanje").addClass('sakrij');
        }
    })
}

function login() {
    var kor_ime, sifra, reKorIme;
    var validate = true;

    kor_ime = document.getElementById('kor_ime').value;
    sifra = document.getElementById('lozinka').value;
    reKorIme = /^[a-zA-Z0-9_\-\.]{5,}$/;


    if (kor_ime == "") {
        document.getElementById("kor_imeGreska").innerHTML = "Korisničko ime je obavezno.";
        validate = false;
    } else if (!reKorIme.test(kor_ime)) {
        document.getElementById("kor_imeGreska").innerHTML = "Korisničko ime nije ispravno.";
        validate = false;
    } else {
        document.getElementById("kor_imeGreska").innerHTML = "";
    }

    if (sifra == "") {
        document.getElementById("lozinkaGreska").innerHTML = "Šifra je obavezna.";
        validate = false;
    } else {
        document.getElementById("lozinkaGreska").innerHTML = "";
    }

    if (validate) {
        $.ajax({
            url: baseUrl + "/login",
            method: "POST",
            data: {
                kor_ime: kor_ime,
                sifra: sifra,
                _token : token
            },
            success: function (data) {
                window.location.replace(baseUrl + data)
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function dodajSmer(){
    var naziv, reNaziv;
    var validate = true;

    naziv = document.getElementById("smer").value;
    reNaziv = /^([A-ZŠĐŽČĆ][a-zšđžčć]{2,})\s?([a-zšđžčć]{2,}\s?)*$/;

    if (naziv == "") {
        document.getElementById("smerGreska").innerHTML = "Naziv je obavezan.";
        validate = false;
    } else if (!reNaziv.test(naziv)) {
        document.getElementById("smerGreska").innerHTML = "Naziv može sadržati samo slova i mora početi velikim slovom.";
        validate = false;
    } else {
        document.getElementById("smerGreska").innerHTML = "";
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/smerovi/insert",
            method: "POST",
            data: {
                naziv: naziv,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function dodajPredmet(){
    var naziv, smer, reNaziv;
    var smerovi = [];
    var validate = true;
    naziv = document.getElementById('predmet').value;
    reNaziv = /^([A-ZŠĐŽČĆ][a-zšđžčć]{2,})\s?([a-zšđžčć]{2,}\s?)*$/;
    smer = $(".smerPredmet:checked");
    for (let i=0; i<smer.length; i++){
        smerovi.push(smer[i].value)
    }

    if (naziv == "") {
        document.getElementById("predmetGreska").innerHTML = "Naziv je obavezan.";
        validate = false;
    } else if (!reNaziv.test(naziv)) {
        document.getElementById("predmetGreska").innerHTML = "Naziv može sadržati samo slova i mora početi velikim slovom.";
        validate = false;
    } else {
        document.getElementById("predmetGreska").innerHTML = "";
    }

    if (smerovi.length == 0) {
        document.getElementById("smerPredmetGreska").innerHTML = "Smer je obavezan.";
        validate = false;
    } else {
        document.getElementById("smerPredmetGreska").innerHTML = "";
    }

    if(validate){

            $.ajax({
                url: baseUrl + "/predmeti/insert",
                method: "POST",
                data: {
                    naziv: naziv,
                    smerovi : smerovi,
                    _token : token
                },
                success: function (data) {
                    alert(data);
                    window.location.reload();
                },
                error: function (xhr, status, err) {
                    if(xhr.status == 400){
                        alert(xhr.responseJSON.errorMsg);
                    }
                }
            })

    }
}

function filterPredmet(){
    var id = this.value;

    $.ajax({
        url: baseUrl + "/odeljenja/filter",
        method: "get",
        data: {
            id : id
        },
        success: function (data) {
            ispisiPredmeteSmer(data);
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiPredmeteSmer(data){
    let html = '<p class="mt-3 naslovPredmeti">Predmeti</p>';

    data.forEach(el => {
        html += `<div class="form-check">
                                    <input class="form-check-input predmetiOdeljenje" name="predmetiOdeljenje[]" type="checkbox" value="${el.id_predmet}|${el.id_korisnik}">
                                    <label class="form-check-label" for="predmetiOdeljenje">
                                        <span class="text-danger">${el.naziv}</span> | ${el.ime} ${el.prezime}
                                    </label>
                                </div>`
    })

    html += `<p class="text-danger" id="predmetiOdeljenjeG"></p>`;
    $("#prikaziPredmete").html(html);
}

function dodajOdeljenje(){
    var broj, godina, razredni, smer, predmet, reBroj, reGodina;
    var validate = true;
    var predmeti = [];

    broj = document.getElementById('brojOdeljenja').value;
    godina = document.getElementById('godina').value;
    razredni = document.getElementById('razredni').value;
    smer = document.getElementById('smerOdeljenje').value;
    predmet = $(".predmetiOdeljenje:checked");
    for (let i=0; i<predmet.length; i++){
        predmeti.push(predmet[i].value)
    }

    reBroj = /^[1-9]+$/;
    reGodina = /^[1-4]+$/;

    if (broj == "") {
        document.getElementById("brojOdeljenjaG").innerHTML = "Broj odeljenja je obavezan.";
        validate = false;
    } else if (!reBroj.test(broj)) {
        document.getElementById("brojOdeljenjaG").innerHTML = "Dozvoljeni su samo brojevi.";
        validate = false;
    } else {
        document.getElementById("brojOdeljenjaG").innerHTML = "";
    }

    if (godina == "") {
        document.getElementById("godinaG").innerHTML = "Godina je obavezna.";
        validate = false;
    } else if (!reGodina.test(godina)) {
        document.getElementById("godinaG").innerHTML = "Dozvoljeni su samo brojevi od 1 do 4.";
        validate = false;
    } else {
        document.getElementById("godinaG").innerHTML = "";
    }

    if (razredni == "0") {
        document.getElementById("razredniG").innerHTML = "Razredni starešina je obavezan.";
        validate = false;
    } else {
        document.getElementById("razredniG").innerHTML = "";
    }

    if (smer == "0") {
        document.getElementById("smerOdeljenjeG").innerHTML = "Smer je obavezan.";
        validate = false;
    } else {
        document.getElementById("smerOdeljenjeG").innerHTML = "";
    }

    if (predmet.length == 0) {
        document.getElementById("predmetiOdeljenjeG").innerHTML = "Predmeti su obavezni.";
        validate = false;
    } else {
        document.getElementById("predmetiOdeljenjeG").innerHTML = "";
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/odeljenja/insert",
            method: "post",
            data: {
                broj: broj,
                godina: godina,
                razredni:razredni,
                smer:smer,
                predmeti:predmeti,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }

}

function dohvatiCasove(e){
    e.preventDefault();
    var datum = $(this).parent().next().val();
    var ulogovani = $(this).parent().next().next().val();
    var link = $(this);
    var id = window.location.href.split('/')[6];

    $.ajax({
        url: baseUrl + "/dnevnik/"+ id +"/filter",
        method: "get",
        data: {
            datum: datum
        },
        success: function (data) {
            ispisiCasove(data);
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })

    function ispisiCasove(data){
        let html = '';

        data.forEach(el => {
            html += `<div class="d-flex justify-content-start kolonaCasovi mt-3 mb-3">
                    <div class="casRed">
                        <p>${el.po_redu}. čas</p>
                    </div>
                    <div class="casOpis">
                            <p class="ms-1 predmetCas">${el.naziv}</p>
                            <span class="ms-1 nastavnaJedinica">${el.opis}</span>
                            <p class="ms-1 mt-1 text-muted">${el.prezime} ${el.ime}</p>`
                            if(ulogovani == el.id_korisnik){
                                html += `<a href="#modalIzmeniCas" data-bs-toggle="modal" class="btn-sm linkPocetna linkIzmeniCas float-end ms-1" title="Izmeni čas"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>`
                            }
                        html +=`<a href="#exampleModalCenter" data-bs-toggle="modal" class="btn-sm linkPocetna linkOdsutni float-end" title="Odsutni"> <i class="fa fa-user-times" aria-hidden="true"></i> </a>
                       <input type="hidden" class="idcas" value="${el.id_cas}">
                </div>
            </div>`
        })

        link.parent().parent().find('.casovi').html(html);
        $('.linkOdsutni').click(dohvatiOdsutne)
        $('.linkIzmeniCas').click(ispisiFormuCas);
    }
}

function dohvatiOdsutne(e){
    e.preventDefault()
    var id = $(this).next().val();

    $.ajax({
        url: baseUrl + "/dnevnik/"+ id +"/odsutni",
        method: "get",
        data: {
            id : id
        },
        success: function (data) {
            ispisiOdsutne(data);
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiOdsutne(data){
    let html = '';
    data.forEach(el => {
        html += `<p>${el.ime} ${el.prezime}</p>`
    })

    if(data.length > 0){
        $("#modalBody").html(html);
    }
    else {
        $("#modalBody").html("Nema odsutnih.");
    }
}

function ispisiFormuCas(){
    var id = $(this).next().next().val();

    $.ajax({
        url: baseUrl + "/dnevnik/"+ id +"/edit",
        method: "get",
        data: {
            id : id
        },
        success: function (data) {
            data.forEach(el => {
                $("#nastavnaJedUpdate").val(el.opis);
                $("#napomenaUpdate").val(el.napomena);
                $("#casId").val(el.id_cas);
            })
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function upisiCas() {
    var id, opis, datum, brojCasa, odsutni, napomena, reBroj;
    var odsutniNiz = [];
    var validate = true;

    opis = document.getElementById('opis').value;
    datum = document.getElementById('datumCas').value;
    brojCasa = document.getElementById('brojCasa').value;
    napomena = document.getElementById('napomena').value;
    odsutni = $(".odsutniCas:checked");
    for (let i = 0; i < odsutni.length; i++) {
        odsutniNiz.push(odsutni[i].value)
    }
    id = window.location.href.split('/')[6];
    reBroj = /^[0-9]+$/;

    if (opis == "") {
        document.getElementById("opisGreska").innerHTML = "Opis je obavezan.";
        validate = false;
    } else {
        document.getElementById("opisGreska").innerHTML = "";
    }

    if (datum == "") {
        document.getElementById("datumGreska").innerHTML = "Datum je obavezan.";
        validate = false;
    } else {
        document.getElementById("datumGreska").innerHTML = "";
    }

    if (brojCasa == "") {
        document.getElementById("brojCasaGreska").innerHTML = "Redni broj časa je obavezan.";
        validate = false;
    } else if (!reBroj.test(brojCasa)){
        document.getElementById("brojCasaGreska").innerHTML = "Dozvoljeni su samo brojevi.";
        validate = false;
    } else {
        document.getElementById("brojCasaGreska").innerHTML = "";
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/cas/" + id + "/insert",
            method: "post",
            data: {
                id: id,
                opis: opis,
                datum: datum,
                brojCasa: brojCasa,
                odsutniNiz: odsutniNiz,
                napomena: napomena,
                _token: token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if (xhr.status == 400) {
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function dohvatiOcene(){
    var predmet = this.value;
    var idpredmet = document.getElementById('idpredmet').value;
    var id = window.location.href.split('/')[6];

    $.ajax({
        url: baseUrl + "/ucenik/"+ id +"/filter",
        method: "get",
        data: {
            id : id,
            predmet: predmet
        },
        success: function (data) {
            ispisiOcene(data, ".polugodista");
            ispisiProsek(data.prosek, ".prosekPrvo", 1);
            ispisiProsek(data.prosek2, ".prosekDrugo", 2);
            ispisiZakljucnu(data, "#zakljucneUcenik")
            if(predmet != "0"){
                $(".izaberitePredmet").hide();
                $(".polugodista").addClass('d-flex');
                $(".prosek").addClass('d-flex');
                $("#zakljucneUcenik").addClass('d-flex');
                $("#zakljucnaNaslov").removeClass('sakrij');
                ispisiOcene(data, ".polugodista");
                ispisiProsek(data.prosek, ".prosekPrvo");
                ispisiProsek(data.prosek2, ".prosekDrugo");
                ispisiZakljucnu(data, "#zakljucneUcenik");
            }
            else {
                $(".izaberitePredmet").show();
                $(".polugodista").removeClass('d-flex');
                $(".prosek").removeClass('d-flex');
                $("#zakljucneUcenik").removeClass('d-flex');
                $("#zakljucnaNaslov").addClass('sakrij');
                $(".polugodista").hide();
                $(".prosek").hide();
                $("#zakljucneUcenik").hide();
            }
            if(idpredmet != null){
                if(idpredmet != predmet){
                    $("#prikaziOcenu").hide();
                    $("#prikaziZakljucnu").hide();
                }
                else {
                    $("#prikaziOcenu").show();
                    $("#prikaziZakljucnu").show();
                }
            }
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiProsek(data, polugodiste, broj){
    html = '';

    data.forEach(el => {
        html += `<div class="srednja">
                                    <p>Srednja ocena (`
                                    if(broj == 1){
                                        html += `I `
                                    }
                                    else {
                                        html += `II `
                                    }
                                    html += `Polugodište)</p>
                                </div>
                                <div class="srednjaOcena">
                                    <p class="fw-bold">${Math.round(el.prosecnaOcena * 100) / 100}</p>
                                </div>`
    })

    $(polugodiste).html(html);
}

function ispisiOcene(data, id){
    let html = '';

    html += `<div class="col-lg-6 mt-4">
                            <div class="naslovPolugodiste mb-4">
                                <h3 class="polugodiste">I Polugodište</h3>
                            </div>
                            <div class="w-100 d-flex justify-content-between">
                                <div class="polug1 d-flex w-50">`
                                    data.ocene.forEach(el => {
                                       if(el.id_polugodiste == 1){
                                          html+=` <div title="${el.vrsta}" class="ocena">
                                            <span>${el.ocena}</span>
                                          </div>`
                                   }
                                })
                                html += `</div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="naslovPolugodiste mb-4">
                                <h3 class="polugodiste">II Polugodište</h3>
                            </div>
                            <div class="w-100 d-flex justify-content-between">
                                <div class="polug2 d-flex w-50">`
                                    data.ocene.forEach(el => {
                                        if(el.id_polugodiste == 2){
                                            html+=` <div title="${ el.vrsta }" class="ocena">
                                                                            <span>${el.ocena}</span>
                                                                          </div>`
                                        }
                                    })
                                html += `</div>
                            </div>
                        </div>`

    $(id).html(html)

}

function ispisiZakljucnu(data, id){
    let html = "";

    html += `<div class="zakljucnaPolugodiste me-3 mt-2">
                <h6>I Polugodište</h6>`
                if(data.zakljucna1.length > 0){
                    data.zakljucna1.forEach(z => {
                            switch (z.zakljucna_ocena){
                                case 1:
                                    html += `<p>nedovoljan (${z.zakljucna_ocena})</p>`
                                    break
                                case 2:
                                    html += `<p>dovoljan (${z.zakljucna_ocena})</p>`
                                    break
                                case 3:
                                    html += `<p>dobar (${z.zakljucna_ocena})</p>`
                                    break
                                case 4:
                                    html += `<p>vrlo dobar (${z.zakljucna_ocena})</p>`
                                    break
                                case 5:
                                    html += `<p>odličan (${z.zakljucna_ocena})</p>`
                                    break
                            }
                    })
                }
                else {
                    html += `<p>&ndash;</p>`
                }
                html += `</div>
                         <div class="zakljucnaPolugodiste me-3 mt-2">
                         <h6>II Polugodište</h6>`
                         if(data.zakljucna2.length > 0){
                             data.zakljucna2.forEach(z => {
                                     switch (z.zakljucna_ocena) {
                                         case 1:
                                             html += `<p>nedovoljan (${z.zakljucna_ocena})</p>`
                                             break
                                         case 2:
                                             html += `<p>dovoljan (${z.zakljucna_ocena})</p>`
                                             break
                                         case 3:
                                             html += `<p>dobar (${z.zakljucna_ocena})</p>`
                                             break
                                         case 4:
                                             html += `<p>vrlo dobar (${z.zakljucna_ocena})</p>`
                                             break
                                         case 5:
                                             html += `<p>odličan (${z.zakljucna_ocena})</p>`
                                             break
                                     }
                             })
                         }
                         else {
                             html += `<p>&ndash;</p>`
                         }
                         html += `</div>`

    $(id).html(html);
}

function oceni(){
    var ocena, vrsta, reBroj;
    var validate = true;
    var id = window.location.href.split('/')[6];
    ocena = document.getElementById('ocenaVred').value;
    vrsta = document.getElementById('vrstaOcene').value;
    reBroj = /^[1-5]$/;

    if (ocena == "") {
        document.getElementById("ocenaGreska").innerHTML = "Ocena je obavezna.";
        validate = false;
    } else if (!reBroj.test(ocena)) {
        document.getElementById("ocenaGreska").innerHTML = "Dozvoljeni su samo brojevi od 1 do 5.";
        validate = false;
    } else {
        document.getElementById("ocenaGreska").innerHTML = "";
    }

    if (vrsta == "0") {
        document.getElementById("vrstaGreska").innerHTML = "Vrsta ocene je obavezna.";
        validate = false;
    } else {
        document.getElementById("vrstaGreska").innerHTML = "";
    }


    if (validate){
        $.ajax({
            url: baseUrl + "/ucenik/ocena",
            method: "post",
            data: {
                ocena : ocena,
                vrsta : vrsta,
                id : id,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }

}

function zahtev(){
    var pogresna, nova, datum, vrsta, reBroj;
    var id = window.location.href.split('/')[6];
    var validate = true;

    pogresna = document.getElementById('pogresnaOcena').value;
    nova = document.getElementById('novaOcena').value;
    datum = document.getElementById('datumOcene').value;
    vrsta = document.getElementById('vrstaOceneZ').value;
    reBroj = /^[1-5]$/;

    if(pogresna == ""){
        document.getElementById('pogresnaOcenaG').innerHTML = 'Pogrešna ocena je obavezna!'
        validate = false;
    } else if (!reBroj.test(pogresna)){
        document.getElementById('pogresnaOcenaG').innerHTML = 'Dozvoljeni su samo brojevi od 1 do 5!'
        validate = false;
    } else {
        document.getElementById('pogresnaOcenaG').innerHTML = ''
    }

    if(nova == ""){
        document.getElementById('novaOcenaG').innerHTML = 'Nova ocena je obavezna!'
        validate = false;
    } else if (!reBroj.test(nova)){
        document.getElementById('novaOcenaG').innerHTML = 'Dozvoljeni su samo brojevi od 1 do 5!'
        validate = false;
    } else {
        document.getElementById('novaOcenaG').innerHTML = ''
    }

    if(datum == ""){
        document.getElementById('datumOceneG').innerHTML = 'Datum je obavezan!'
        validate = false;
    } else {
        document.getElementById('datumOceneG').innerHTML = ''
    }

    if(vrsta == "0"){
        document.getElementById('vrstaOceneZG').innerHTML = 'Vrsta ocene je obavezna!'
        validate = false;
    } else {
        document.getElementById('vrstaOceneZG').innerHTML = ''
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/ucenik/zahtev",
            method: "post",
            data: {
                pogresna : pogresna,
                nova : nova,
                datum : datum,
                vrsta : vrsta,
                id : id,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function zakljuciOcenu(){
    var ocena, polugodiste;
    var id = window.location.href.split('/')[6];
    var validate = true;

    ocena = document.getElementById('zakljucnaOcena').value;
    reBroj = /^[1-5]$/;

    if (ocena == "") {
        document.getElementById("zakljucnaGreska").innerHTML = "Ocena je obavezna.";
        validate = false;
    } else if (!reBroj.test(ocena)) {
        document.getElementById("zakljucnaGreska").innerHTML = "Dozvoljeni su samo brojevi od 1 do 5.";
        validate = false;
    } else {
        document.getElementById("zakljucnaGreska").innerHTML = "";
    }

    if(document.getElementById('polug') != undefined){
        polugodiste = document.getElementById('polug').value;
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/ucenik/zakljucna",
            method: "post",
            data: {
                ocena : ocena,
                polugodiste : polugodiste,
                id : id,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function dodajKontakt(){
    var ime, prezime, kor_ime, email, lozinka, broj, reIme, rePrezime, reKorIme, reEmail, reBroj;
    var id = window.location.href.split('/')[6];
    var validate = true;

    ime = document.getElementById('imeRegistracija').value;
    prezime = document.getElementById('prezimeRegistracija').value;
    kor_ime = document.getElementById('korImeReg').value;
    email = document.getElementById('emailReg').value;
    lozinka = document.getElementById('sifraReg').value;
    broj = document.getElementById('brojTelefona').value;
    reIme = /^[A-ZŠĐŽČĆ][a-zšđžčć]{1,13}$/;
    rePrezime = /^([A-ZŠĐŽČĆ][a-zšđžčć]{1,30}\s?)+$/;
    reKorIme = /^[A-Za-z0-9\.]{3,20}$/
    reEmail = /^[a-z][a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/;
    reBroj = /^[0-9]+$/;

    if (ime == "") {
        document.getElementById("imeRegistracijaG").innerHTML = "Ime je obavezno.";
        validate = false;
    } else if (!reIme.test(ime)) {
        document.getElementById("imeRegistracijaG").innerHTML = "Ime nije u ispravnom formatu";
        validate = false;
    } else {
        document.getElementById("imeRegistracijaG").innerHTML = "";
    }

    if (prezime == "") {
        document.getElementById("prezimeRegistracijaG").innerHTML = "Prezime je obavezno.";
        validate = false;
    } else if (!rePrezime.test(prezime)) {
        document.getElementById("prezimeRegistracijaG").innerHTML = "Prezime nije u ispravnom formatu";
        validate = false;
    } else {
        document.getElementById("prezimeRegistracijaG").innerHTML = "";
    }

    if (kor_ime == "") {
        document.getElementById("korImeRegG").innerHTML = "Korisničko ime je obavezno.";
        validate = false;
    } else if (!reKorIme.test(kor_ime)) {
        document.getElementById("korImeRegG").innerHTML = "Korisničko ime nije u ispravnom formatu";
        validate = false;
    } else {
        document.getElementById("korImeRegG").innerHTML = "";
    }

    if (email == "") {
        document.getElementById("emailRegG").innerHTML = "Ime je obavezno.";
        validate = false;
    } else if (!reEmail.test(email)) {
        document.getElementById("emailRegG").innerHTML = "Email nije u ispravnom formatu";
        validate = false;
    } else {
        document.getElementById("emailRegG").innerHTML = "";
    }

    if (broj == "") {
        document.getElementById("brojTelefonaG").innerHTML = "Broj je obavezan.";
        validate = false;
    } else if (!reBroj.test(broj)) {
        document.getElementById("brojTelefonaG").innerHTML = "Broj nije u ispravnom formatu";
        validate = false;
    } else {
        document.getElementById("brojTelefonaG").innerHTML = "";
    }

    if (lozinka == "") {
        document.getElementById("sifraRegG").innerHTML = "Lozinka je obavezna.";
        validate = false;
    } else if (lozinka.length < 8) {
        document.getElementById("sifraRegG").innerHTML = "Lozinka mora imati minimalno 8 karaktera";
        validate = false;
    } else {
        document.getElementById("sifraRegG").innerHTML = "";
    }

    if(validate){
        $.ajax({
            url: baseUrl + "/roditelj",
            method: "post",
            data: {
                ime : ime,
                prezime : prezime,
                kor_ime : kor_ime,
                email : email,
                lozinka : lozinka,
                broj : broj,
                id : id
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function r(){
    var id = $("#ucenikRoditelj option:selected").val()
    var idpredmet = $("#predmetiR").val();

    $.ajax({
        url: baseUrl + "/roditelj/filter",
        method: "get",
        data: {
            id : id,
            idpredmet : idpredmet
        },
        success: function (data) {
            ispisiIzostanci(data)
            ispisiLevoRoditelj(data.ucenik)
            ispisiPredmeteRoditelj(data.predmeti)
            ispisiPadajucuListu(data.predmeti)
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiLevoRoditelj(data){
    let html = "";

    data.forEach(el => {
        html +=  `<div class="slikaIme">
                        <img class="img-fluid mb-2 mt-4 slika" src= "assets/images/${el.slika}">
                        <div class="imeSmer">
                            <p class="ime mt-2">${el.prezime} ${el.ime}</p>
                            <p class="text-muted">${el.naziv} (4) </p>
                        </div>
                    </div>
                    <div class="w-75 m-auto d-flex mb-3 justify-content-start divTekstVladanje vroditelj">
                            <p class="tekstVladanje">Ocena iz vladanja</p>
                            <p class="ocenaVladanje">${el.vladanje}</p>
                        </div>`
    })

    $("#roditeljLevo").html(html);
}

function dohvatiOceneRoditelj(){
    var predmet = this.value;
    var ucenik = $("#ucenikRoditelj").val();

    $.ajax({
        url: baseUrl + "/roditelj/filter",
        method: "get",
        data: {
            predmet: predmet,
            ucenik: ucenik
        },
        success: function (data) {
            if(predmet != "0"){
                $(".izaberitePredmet").hide();
                $("#oceneRoditelj").addClass('d-flex');
                $("#prosekPrvoR").addClass('d-flex');
                $("#prosekDrugoR").addClass('d-flex');
                $("#zakljucneRoditelj").addClass('d-flex');
                $("#zakljucnaNaslov").removeClass('sakrij');
                ispisiOcene(data, "#oceneRoditelj");
                ispisiProsek(data.prosek, "#prosekPrvoR");
                ispisiProsek(data.prosek2, "#prosekDrugoR");
                ispisiZakljucnu(data, "#zakljucneRoditelj");
            }
            else {
                $(".izaberitePredmet").show();
                $("#oceneRoditelj").removeClass('d-flex');
                $("#prosekPrvoR").removeClass('d-flex');
                $("#prosekDrugoR").removeClass('d-flex');
                $("#zakljucneRoditelj").removeClass('d-flex');
                $("#zakljucnaNaslov").addClass('sakrij');
                $("#oceneRoditelj").hide();
                $("#prosekPrvoR").hide();
                $("#prosekDrugoR").hide();
                $("#zakljucneRoditelj").hide();
            }
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function roditelj(){
    var id = this.value;

    $.ajax({
        url: baseUrl + "/roditelj/filter",
        method: "get",
        data: {
            id : id
        },
        success: function (data) {
            ispisiIzostanci(data)
            ispisiLevoRoditelj(data.ucenik)
            ispisiPredmeteRoditelj(data.predmeti)
            ispisiPadajucuListu(data.predmeti)
            var predmet = $("#predmetiR").val();
            console.log(predmet)
            if(predmet != "0"){
                $(".izaberitePredmet").hide();
                $("#oceneRoditelj").addClass('d-flex');
                $("#prosekPrvoR").addClass('d-flex');
                $("#prosekDrugoR").addClass('d-flex');
                $("#zakljucneRoditelj").addClass('d-flex');
                $("#zakljucnaNaslov").removeClass('sakrij');
                ispisiOcene(data, "#oceneRoditelj");
                ispisiProsek(data.prosek, "#prosekPrvoR");
                ispisiProsek(data.prosek2, "#prosekDrugoR");
                ispisiZakljucnu(data, "#zakljucneRoditelj");
            }
            else {
                $(".izaberitePredmet").show();
                $("#oceneRoditelj").removeClass('d-flex');
                $("#prosekPrvoR").removeClass('d-flex');
                $("#prosekDrugoR").removeClass('d-flex');
                $("#zakljucneRoditelj").removeClass('d-flex');
                $("#zakljucnaNaslov").addClass('sakrij');
                $("#oceneRoditelj").hide();
                $("#prosekPrvoR").hide();
                $("#prosekDrugoR").hide();
                $("#zakljucneRoditelj").hide();
            }
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiIzostanci(data){

    let html = `<div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci neregulisani">
                                <span>${data.neregulisani.length}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">neregulisani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci opravdani">
                                <span>${data.opravdano.length}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">opravdani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci neopravdani">
                                <span>${data.neopravdano.length}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">neopravdani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci ukupno">
                                <span>${data.neopravdano.length + data.opravdano.length + data.neregulisani.length}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">ukupno</p>
                            </div>
                        </div>`

    $("#izostanciRoditelj").html(html)

}

function ispisiPredmeteRoditelj(data){
    let html = '';

    data.forEach(el => {
        html += `<tr>
                    <td class="nazivPredmeta">${el.naziv}</td>
                    <td>${el.prezime} ${el.ime}</td>
                  </tr>`
    })

    $("#predmetiRoditelj").html(html);
}

function ispisiPadajucuListu(data){
    let html = '<option value="0">Izaberite predmet...</option>';

    data.forEach(el => {
        html += `<option value='${el.id_predmet}'>${el.naziv}</option>`
    })

    $("#predmetiR").html(html)
}

function charts(id, labels, label, data, background, border){
    if(document.getElementById(id) != null){
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: background,
                    borderColor: border,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
}

function dohvatiIzostankeDirektor(){
    $.ajax({
        url: baseUrl + "/home/direktor",
        method: "get",
        success: function (data) {
            charts(
                "izostanciChart",
                ["Neregulisani", "Opravdani", "Neopravdani", "Ukupno"],
                'Izostanci',
                [
                    data.neregulisani.length,
                    data.opravdano.length,
                    data.neopravdano.length,
                    data.opravdano.length +  data.neopravdano.length + data.neregulisani.length
                ],
                [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(153, 102, 255, 1)'
                ]
            );
            charts(
                "zahteviChart",
                ["Odobreni", "Neodobreni", "Ukupno"],
                'Zahtevi za izmenu ocene',
                [
                    data.odobreni.length,
                    data.neodobreni.length,
                    data.odobreni.length + data.neodobreni.length
                ],
                [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(153, 102, 255, 1)'
                ]
            );
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function filterDatum(){
    var datum = document.getElementById('casDatum').value;
    var id  = window.location.href.split('/')[6];

    $.ajax({
        url: baseUrl + "/dnevnik/"+ id +"/filterDatum",
        method: "get",
        data: {
            datum: datum
        },
        success: function (data) {
            ispisiDatum(data);
            $(".pagination").hide();
            $(".containerDnevnik").addClass('visina');
        },
        error: function (xhr, status, err) {
            if(xhr.status == 400){
                alert(xhr.responseJSON.errorMsg);
            }
        }
    })
}

function ispisiDatum(data){
    let html = '';

    data.forEach(el => {
        html += `<div class="col-lg-12">
                    <div class="row datumCas">
                        <a href="#" class="datum dan">`
                        var dan = new Date(el.datum).getDay();
                        var datum = el.datum.split('-')[2] + '.' + el.datum.split('-')[1] + '.' + el.datum.split('-')[0] + '.';
                        if(dan == 1){
                            html += `Ponedeljak `
                        }
                        else if(dan == 2){
                            html += `Utorak `
                        }
                        else if(dan == 3){
                            html += `Sreda `
                        }
                        else if(dan == 4){
                            html += `Četvrtak `
                        }
                        else if(dan == 5){
                            html += `Petak `
                        }

                        html += ` </a>
                       <a href="#" class="datum d">${datum}</a>
                    </div>
                    <input type="hidden" class="datumVred" value="${el.datum}">
                    <div class="row casovi d-flex justify-content-start">

                    </div>
                </div>`
    })

    $("#datumi").html(html);
    $(".datum").click(dohvatiCasove);
}

function loadMore(e){
    e.preventDefault();
    let page = $(this).data("page");
    getDates(page);
}

function getDates(page){
    const caller = arguments.callee.caller.name;
    var id  = window.location.href.split('/')[6];

    $.ajax({
        url: baseUrl + "/dnevnik/"+ id +"/paginacija",
        method: "get",
        data: {
            page : page
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            if(response.data.length > 0){
                ispisiDatum(response.data);
                if(caller == 'loadMore'){
                    changeActivePageLink(response.current_page);
                }
                $(".pagination").show();
            }
            else {
                // $("#products").html("<div class='row mb-5'><div class='col-lg-12 d-flex justify-content-center'><h2>No products in this category!</h2></div></div>");
                $(".pagination").hide();
            }

        },
        error: function (xhr, status, err) {
            console.log(xhr.status)
        }
    })
}

function changeActivePageLink(currentPage){
    $('.page-item').removeClass('active');
    $('#link' + currentPage).parent().addClass('active');
}
