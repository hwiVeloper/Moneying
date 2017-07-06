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
</head>
<body>
    <div class="container-fluid">
        @include('layouts.flash')
        <div class="layer col-md-4 col-offset-md-4">
            <div class="login-title">
                {{-- <h3>Moneying으로 가계부를 시작하세요 !</h3> --}}
            </div>
            {{-- Form Start --}}
            <form autocomplete="off" method="post" action="">
                {{ csrf_field() }}
                {{-- email --}}
                <div class= "form-group">
                    <input class="form-control" type="text" id="email" name="email" tabindex="1"
                    placeholder="이메일"/>
                </div>
                {{-- password --}}
                <div class= "form-group">
                    <input class="form-control" type="password" id="password" name="password" tabindex="2"
                    placeholder="비밀번호"/>
                </div>
                {{-- remember me --}}
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember" tabindex="3">
                        기억하기
                    </label>
                </div>
                {{-- Submit button --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">로그인</button>
                </div>
                <div class="form-group">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-block" tabindex="5">계정 생성</a>
                </div>
                {{-- Social login 들어갈 부분 --}}
            </form>
        </div>
    </div>
</body>
</html>