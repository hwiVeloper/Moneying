@extends('layouts.app')

@section('pageTitle', '메인')

@section('style')
<style media="screen">
    .table {
        height: 100%;
        text-align: center;
    }

    .table th {
        text-align: center;
    }

    .cal-table td {
        vertical-align: middle;
    }

    .cal-weekrow {
        font-weight: bold;
    }

    .cal-highlight {
        font-weight: bold;
    }

    .cal-today {
        background-color: #75cdff;
    }

    .cal-td {
        cursor: pointer;
    }
</style>
@stop

@section('script')
    <script type="text/javascript">
    $(document).ready(function() {

    });
    </script>
@stop

@section('contents')
<div class="row">
    <div class="col-md-6">
        <h3>메인화면입니다.</h3>
    </div>
    <div class="col-md-6">
        {{-- 수입/지출 내역 입력 폼 --}}
        <form class="form-inline" action="" method="post">
            <select class="form-control" name="asset_id" {{ $asset_count == 0 ? 'disabled' : '' }}>
                @forelse ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                @empty
                    <option value="" selected disabled>자산등록필요</option>
                @endforelse
            </select>
            <input class="form-control" type="text" name="description" value="" placeholder="내역 메모">
            <input class="form-control" type="number" name="amount" value="" placeholder="금액">
            <button type="button" class="btn btn-primary" {{ $asset_count == 0 ? 'disabled' : '' }}>내역 입력</button>
        </form>
    </div>
</div>
<div class="row" style="margin-top:0.5em;">
    <div class="col-md-6">
        {{-- 달력 들어갈 자리 --}}
        {!! $calendar !!}
    </div>
    <div class="col-md-6">
        <table class="table">
            <thead>
                <th>구분</th>
                <th>카테고리</th>
                <th>내역</th>
                <th>금액</th>
            </thead>
            <tbody>
                @forelse ($accounts as $account)
                    <tr>
                        <td>{{ $account->type }}</td>
                        <td>{{ $account->category_id }}</td>
                        <td>{{ $account->description }}</td>
                        <td>{{ $account->amount }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">내역이 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop