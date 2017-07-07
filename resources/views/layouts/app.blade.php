{{-- header 안에 style --}}
@include('layouts.header')

@include('layouts.navigation')

<div class="container-fluid">
    @include('layouts.flash')

    {{-- 공백 --}}
    <div style="margin-top:1em;"></div>

    @yield('contents')
</div>

@yield('scripts')

@include('layouts.footer')