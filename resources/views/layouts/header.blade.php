<!DOCTYPE html>
<html lang="{{ config('app.locale', 'ko') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Moneying') }} | @yield('pageTitle')</title>

    {{-- Scripts --}}
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script type="text/javascript" src="{{ mix('/js/all.js') }}"></script>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
    @yield('style')
</head>
<body>