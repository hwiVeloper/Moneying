<script type="text/javascript">
$( document ).ready(function() {

    // Open navbarSide when button is clicked
    $('#navbarSideButton').click(function(e) {
        $(this).attr('disabled', true);
        $('#navbarSide').toggleClass('reveal');
        $('#overlay').show();
    });

    // Close navbarSide when the outside of menu is clicked
    $('#overlay').click(function(){
        $('#navbarSideButton').attr('disabled', false);
        $('#navbarSide').toggleClass('reveal');
        $('#overlay').hide();
    });

    $('#sidebar-close').click(function() {
        $('#navbarSideButton').attr('disabled', false);
        $('#navbarSide').toggleClass('reveal');
        $('#overlay').hide();
    });
});
</script>
<nav class="navbar sticky-top navbar-inverse bg-moneying" role="navigation">
    <button class="navbar-toggler" id="navbarSideButton" type="button">
        <i class="fa fa-bars"></i>
    </button>
    @if (!Auth::guest())
    <!-- 사이드바 내용 시작 -->
    <ul class="navbar-side reveal" id="navbarSide">
        <li id="profile" class="navbar-side-item">
            <img src="{{ Auth::user()->avatar }}" alt="" style="max-height:100px">
            <p class="profile-name">{{ Auth::user()->name }}</p>
            <p class="profile-email">{{ Auth::user()->email }}</p>
            <i id="sidebar-close" class="fa fa-times fa-2x"></i>
        </li>
        <a class="navbar-side-link" href="{{ url('/') }}"><li class="navbar-side-item"><i class="fa fa-home fa-lg fa-fw"></i>&nbsp;홈</li></a>
        <a class="navbar-side-link" href="{{ url('dashboard') }}"><li class="navbar-side-item"><i class="fa fa-dashboard fa-lg fa-fw"></i>&nbsp;요약</li></a>
        <a class="navbar-side-link" href="{{ url('assets') }}"><li class="navbar-side-item"><i class="fa fa-money fa-lg fa-fw"></i>&nbsp;자산관리</li></a>
        <a class="navbar-side-link" href="#"><li class="navbar-side-item"><i class="fa fa-cog fa-lg fa-fw"></i>&nbsp;설정 (준비중))</li></a>

        <a id="logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw">&nbsp;</i>로그아웃</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
    <!-- 사이드바 내용 끝 -->
    @endif
</nav>
<div id="overlay"></div>