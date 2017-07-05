@extends('layouts.app')

@section('pageTitle', '메인')

@section('contents')
    <div class="page-header">
        <h1>Welcome! {{ Auth::user()->name }}</h1>
    </div>
    <hr>
@endsection