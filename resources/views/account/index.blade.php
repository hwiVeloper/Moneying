@extends('layouts.app')

@section('pageTitle', '메인')

@section('script')
    <script type="text/javascript">
    $('.cal-link').each(function() {
        if ( $(this).html() == <?php echo $date; ?> ) {
            $(this).parent().addClass('cal-selected');
        }
    });
    $(document).ready(function() {
        $('#inc_exp').on('change', function() {
            $.ajax({
                type: 'post',
                dataType: 'html',
                url: '{{ route("accounts.changeType") }}',
                data: {"_token": "{{ csrf_token() }}",
                       "type": $(this).val()
                },
                success: function (data) {
                    console.log(data);
                    $('#category').empty().append(data);
                },
                error: function (request, status, error) {
                    console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
                }
            });
        });
    });
    </script>
@stop

@section('contents')
<div class="row">
    <div class="col-md-6">
        {{-- <h3>메인화면입니다.</h3> --}}
    </div>
    <div class="col-md-6" align="right">
        <span style="color: #999">( 이번달 수입/지출 - 추후 개발 )</span>
    </div>
</div>
<div class="row" style="margin-top:0.5em;">
    <div class="col-md-6">
        {!! $calendar !!}
    </div>
    <div class="col-md-6">
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-pencil">&nbsp;</i>내역 입력
                        </a>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-block">
                        {{-- 수입/지출 내역 입력 폼 --}}
                        <form action="{{ route('accounts.store') }}" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for="type">구분</label>
                                <div class="col-9">
                                    <select id="inc_exp" class="form-control" name="type" {{ $asset_count == 0 ? 'disabled' : '' }}>
                                        <option value="1">수입</option>
                                        <option value="2">지출</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for="category_id">카테고리</label>
                                <div class="col-9">
                                    <select id="category" class="form-control" name="category_id" {{ $asset_count == 0 ? 'disabled' : '' }}>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            {{-- nothing --}}
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for="asset_id">자산구분</label>
                                <div class="col-9">
                                    <select class="form-control" name="asset_id" {{ $asset_count == 0 ? 'disabled' : '' }}>
                                        @forelse ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                        @empty
                                            <option value="" selected>자산등록필요</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for="description">내역</label>
                                <div class="col-9">
                                    <input class="form-control" type="text" name="description" value="" placeholder="내역 메모" {{ $asset_count == 0 ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for="amount">금액</label>
                                <div class="col-9">
                                    <input class="form-control" type="number" name="amount" value="" placeholder="금액" {{ $asset_count == 0 ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label" for=""></label>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-primary btn-block" {{ $asset_count == 0 ? 'disabled' : '' }}>내역 입력</button>
                                </div>
                            </div>
                            {{-- hidden values --}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="date" value="{{ $ymd }}">
                            <input type="hidden" name="red_ymd" value="{{ $red_ymd }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-sm table-hover" style="margin-top: 1em;">
            <thead>
                <th class="hidden-md-down">구분</th>
                <th class="hidden-md-down">카테고리</th>
                <th>자산구분</th>
                <th>내역</th>
                <th>금액</th>
            </thead>
            <tbody>
                @forelse ($accounts as $account)
                    <tr class="{{ $account->type == 1 ? 'table-success' : 'table-danger' }}">
                        <td class="hidden-md-down">{{ $account->type == 1 ? '수입' : '지출' }}</td>
                        <td class="hidden-md-down">{{ $account->category->name }}</td>
                        <td>{{ $account->asset->name }}</td>
                        <td>{{ $account->description }}</td>
                        <td>{{ $account->amount }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">내역이 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop