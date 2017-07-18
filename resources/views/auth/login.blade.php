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
    <style media="screen">
    html, body {
        width: 100%;
        height:100%;
        overflow:hidden;
    }
    </style>
</head>
<body id="login-page">
    <video id="bg-video" preload="auto" autoplay="false" loop="loop" volume="0" poster="video/pencil_down.jpg">
        {{-- <source src="video/pencil_down.mp4" type="video/mp4" /> --}}
        <source src="video/pencil_down.webm" type="video/webm" />
    </video>
    <div class="container-fluid">
        @include('layouts.flash')
        <div class="layer col-md-4 col-offset-md-4">
            <div class="login-title">
                <h3>Moneying</h3>
            </div>
            <!--
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
            <hr style="margin-top: 3em; margin-bottom: 3em;">-->
            <a href="social/github" class="btn btn-secondary btn-block"><i class="fa fa-github"></i> 깃허브로 로그인</a>
            <a href="social/google" class="btn btn-danger btn-block"><i class="fa fa-google"></i> 구글로 로그인</a>
            <a href="social/facebook" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> 페이스북으로 로그인</a>
        </div>
    </div>
</body>
</html>