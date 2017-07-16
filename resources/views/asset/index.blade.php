@extends('layouts.app')

@section('pageTitle', '자산관리')

@section('style')
<style media="screen">
    .number-cell {
        text-align: right;
    }
</style>
@endsection

@section('script')

@endsection

@section('contents')
<div class="row">
    <div class="col-md-12">
        <h3>Asset 메인 페이지</h3>
    </div>
    <div class="col-md-6">
        {{-- 자산리스트 --}}
        <table class="table">
            <thead>
                <tr>
                    <th>종류</th>
                    <th>이름</th>
                    <th>기초자산</th>
                    <th>잔액</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr>
                        <td>{{ $asset->assetType->name }}</td>
                        <td>{{ $asset->name }}</td>
                        <td class="number-cell">{{ number_format($asset->underlying) }}</td>
                        <td class="number-cell">{{ number_format($asset->amount) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">등록된 자산이 없습니다. 등록해주세요.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        {{-- 자산 등록 --}}
    </div>
</div>
@stop