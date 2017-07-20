@extends('layouts.app')

@section('pageTitle', '요약')

@section('style')
<style media="screen">
    .col-md-12:not(:first-child) {
        margin-top: 0.5em;
    }

    #dashboard {
        width: 100%;
        height: auto;
    }
</style>
@endsection

@section('script')
    <script type="text/javascript">
    $(document).ready(function () {
        weekAndMonth();
    });

    $('#method').on('change', function () {
        weekAndMonth();
        $('#search').submit();
    });

    $('#type').on('change', function () {
        $('#search').submit();
    });

    $('#week').on('change', function () {
        $('#search').submit();
    });

    $('#month').on('change', function () {
        $('#search').submit();
    });

    function weekAndMonth() {
        if( $('#method').val() == 'monthly') {
            $('#monthLabel').show();
            $('#month').show();
            $('#month').attr('disabled', false);

            $('#weekLabel').hide();
            $('#week').hide();
            $('#week').attr('disabled', true);

            $('#month').val('{{ isset($month) ? $month : date('Y-m') }}');
        } else {
            $('#monthLabel').hide();
            $('#month').hide();
            $('#month').attr('disabled', true);

            $('#weekLabel').show();
            $('#week').show();
            $('#week').attr('disabled', false);

            $('#week').val('{{ isset($week) ? $month : date('Y-\WW') }}');
        }
    }
    </script>
@endsection

@section('contents')
<div class="row">
    <div class="col-md-12">
        <h3>Dashboard</h3>
    </div>
    <div class="col-md-12">
        <form class="form-inline" method="post" id="search" action="{{ route('dashboard.index') }}">
            {!! csrf_field() !!}
            <label for="type" class="col-form-label">구분</label>
            <select id="type" class="form-control ml-sm-3 mr-sm-5" name="type">
                <option value="1" {{ $type == 1 || $type == null ? 'selected' : '' }}>수입</option>
                <option value="2" {{ $type == 2 ? 'selected' : '' }}>지출</option>
            </select>
            <label for="method" class="col-form-label">보기방식</label>
            <select id="method" class="form-control ml-sm-3 mr-sm-5" name="method">
                <option value="monthly" {{ $method == 'monthly' || $method == null ? 'selected' : '' }}>월별</option>
                <option value="weekly" {{ $method == 'weekly' ? 'selected' : '' }}>주별</option>
            </select>
            <label id="monthLabel" for="month" class="col-form-label">기준년월</label>
            <input id="month" type="month" class="form-control ml-sm-3 mr-sm-5" name="month" value="{{ $date ?: date('Y-m') }}">
            <label id="weekLabel" for="week" class="col-form-label">기준주차</label>
            <input id="week" type="week" class="form-control ml-sm-3 mr-sm-5" name="week" value="{{ $date ?: date('Y-\WW') }}" >
        </form>
    </div>
    <div class="col-md-12">
        <div class="" id="dashboard" role="tabpanel">{{ $charts->count() > 0 ? '' : '데이터가 없습니다.' }}</div>
    </div>
</div>

{!! $charts->count() > 0 ? Lava::render('ColumnChart', 'dashboard', 'dashboard') : '' !!}
@endsection