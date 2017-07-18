@extends('layouts.app')

@section('pageTitle', '요약')

@section('style')

@endsection

@section('script')

@endsection

@section('contents')
<div class="row">
    <div class="col-md-12">
        <h3>Dashboard</h3>
    </div>
    <div class="col-md-12">
        {{-- button area (yearly, monthly, weekly) --}}
    </div>
    <div class="col-md-12">
        {!! LaravelHighchart::display("dashboardCharts", $charts) !!}
    </div>
</div>
@endsection