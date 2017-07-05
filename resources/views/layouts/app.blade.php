{{-- header 안에 style --}}
@include('layouts.header')

@include('layouts.navigation')

<div class="container-fluid">
    @include('layouts.flash')

    @yield('contents')
</div>

@yield('scripts')

@include('layouts.footer')