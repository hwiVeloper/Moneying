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
        <h3><i class="fa fa-money">&nbsp;</i>자산관리</h3>
    </div>
    <div class="col-md-6">
        {{-- 자산리스트 --}}
        {{-- 큰화면용 --}}
        <table class="table hidden-sm-down">
            <thead>
                <tr>
                    <th>종류</th>
                    <th>이름</th>
                    <th>기초자산</th>
                    <th>잔액</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr>
                        <td>{{ $asset->assetType->name }}</td>
                        <td>{{ $asset->name }}</td>
                        <td class="number-cell">{{ number_format($asset->underlying) }}</td>
                        <td class="number-cell">{{ number_format($asset->amount) }}</td>
                        <td>
                            <form action="{{ route('assets.destroy', $asset->id) }}" method="post"
                                onsubmit="return confirm('관련된 수입/지출 내역도 삭제됩니다. 계속하시겠습니까?')">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="btn btn-danger">삭제</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">등록된 자산이 없습니다. 등록해주세요.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="list-group hidden-md-up mb-4">
            @forelse ($assets as $asset)
                <span href="#" class="list-group-item flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $asset->name }}</h5>
                        <small class="text-muted">{{ $asset->assetType->name }}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">
                            기초자산 : {{ number_format($asset->underlying) }} 원<br>
                            잔액 : {{ number_format($asset->amount) }} 원
                        </p>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="post"
                            onsubmit="return confirm('관련된 수입/지출 내역도 삭제됩니다. 계속하시겠습니까?')">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                        </form>
                    </div>
                </span>
            @empty

            @endforelse
        </div>
    </div>
    <div class="col-md-6">
        {{-- 자산 등록 --}}
        <form class="" action="#" method="post">
            {!! csrf_field() !!}
            <div class="form-group row">
                <label class="col-3 col-form-label">종류</label>
                <div class="col-9">
                    <select class="form-control" name="type">
                        @forelse ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected': '' }}>{{ $type->name }}</option>
                        @empty
                            {{-- Nothing --}}
                        @endforelse
                    </select>
                    {!! $errors->first('type', '<span class="error">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">이름</label>
                <div class="col-9">
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">기초자산</label>
                <div class="col-9">
                    <input class="form-control" type="number" name="underlying" value="{{ old('underlying') }}" required>
                    {!! $errors->first('underlying', '<span class="error">:message</span>') !!}
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group row">
                <label class="col-3 col-form-label"></label>
                <div class="col-9">
                    <button class="btn btn-primary btn-block" type="submit">등록</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop