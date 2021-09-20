@if(session()->has('error'))
    <div class="alert alert-danger mt-4 w-100" role="alert">
        {{ session('error')}}
    </div>
@endif
