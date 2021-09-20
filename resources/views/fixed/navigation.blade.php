<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-book" aria-hidden="true" ></i>eDnevnik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($meni as $m)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($m->ruta) }}">{{ $m -> naziv }}</a>
                    </li>
                @endforeach
                @if(session('korisnik')->id_uloga == 5)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('zahtevi') }}">Zahtevi</a>
                    </li>
                @endif
                @if(session('korisnik')->id_uloga == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('odeljenje', ['id' => session('odeljenje')->id_odeljenje]) }}">Odeljenje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dnevnik', ['id' => session('odeljenje')->id_odeljenje]) }}">Dnevnik</a>
                    </li>
                @endif
                @if(session('korisnik')->id_uloga == 1)
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administracija
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('smerovi') }}">Smerovi</a></li>
                                <li><a class="dropdown-item" href="{{ route('predmeti') }}">Predmeti</a></li>
                                <li><a class="dropdown-item" href="{{ route('odeljenja') }}">Odeljenja</a></li>
                                <li><a class="dropdown-item" href="{{ route('ucenici') }}">Učenici</a></li>
                                <li><a class="dropdown-item" href="{{ route('nastavnici') }}">Nastavnici</a></li>
                                <li><a class="dropdown-item" href="{{ route('registracijaForma') }}">Registracija korisnika</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
                @if(session('korisnik')->id_uloga == 2)
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administracija
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('ucenici') }}">Učenici</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-4 ulogovanResponsive">
                    <li class="nav-item dropdown">
                        <p id="ulogovan">Ulogovani korisnik</p>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('korisnik')->ime }} {{ session('korisnik')->prezime }}
                        </a>
                        <ul class="dropdown-menu nastavnik" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route("profil") }}">Izmeni profil</a></li>
                            @if(session()->has('korisnik'))
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Odjavi se</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </ul>
            <div class="d-flex" id="divPrijavljen">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="tekstPrijavljen" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <span>{{ session('korisnik')->ime }} {{ session('korisnik')->prezime }}</span> <img id="slikaPrijavljen" class="img-thumbnail" src="{{asset("assets/images/". session('korisnik')->slika)}}">
                        </a>
                        <ul class="dropdown-menu nastavnik" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route("profil") }}">Izmeni profil</a></li>
                            @if(session()->has('korisnik'))
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Odjavi se</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
