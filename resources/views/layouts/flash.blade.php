@if(session()->has('flash_message'))
    <div class="row alert alert-info" role="alert">
        {{ session('flash_message') }}
    </div>
@endif