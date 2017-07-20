@extends('layouts.app')

@section('pageTitle', '요약')

@section('style')
<style media="screen">
    .col-md-12:not(:first-child) {
        margin-top: 0.5em;
    }
</style>
@endsection

@section('script')

@endsection

@section('contents')
<div class="row">
    <div class="col-md-12">
        <h3>Dashboard</h3>
    </div>
    <div class="col-md-12">
        <form class="form-inline" method="post">
            <label for="type" class="col-form-label">구분</label>
            <select class="form-control ml-sm-3 mr-sm-5" name="type">
                <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>수입</option>
                <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>지출</option>
            </select>
            <label for="type" class="col-form-label">보기방식</label>
            <select class="form-control ml-sm-3 mr-sm-5" name="type">
                <option value="monthly" {{ old('method') == 'monthly' ? 'selected' : '' }}>월별</option>
                <option value="weekly" {{ old('method') == 'weekly' ? 'selected' : '' }}>주별</option>
            </select>
        </form>
    </div>
    <div class="col-md-12">
        <div class="" id="income" role="tabpanel"></div>
    </div>
</div>

{!! Lava::render('BarChart', 'income', 'income') !!}
@endsection