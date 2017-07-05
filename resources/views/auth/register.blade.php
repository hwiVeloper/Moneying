<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Moneying') }} | Login</title>

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
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="layer col-md-4 col-offset-md-4">
        <div class="register-title">
            <h3>계정 만들기</h3>
        </div>
        <form class="" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="form-label">이름</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="form-label">이메일</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password" class="form-label">비밀번호</label>

                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">비밀번호 확인</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    계정 생성
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>