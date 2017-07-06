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

<style media="screen">
    #logout-btn {
        position: absolute;
        display: inline-block;
        bottom: 0;
        left: 0;
        margin-left: 1em;
        margin-bottom: 1em;
    }
</style>

<nav class="navbar sticky-top navbar-light bg-faded" role="navigation">
    <button class="navbar-toggler" id="navbarSideButton" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- 사이드바 내용 시작 -->
    <ul class="navbar-side reveal" id="navbarSide">
        @if (!Auth::guest())
        <li id="profile" class="navbar-side-item">
            <img src="{{ Auth::user()->avatar }}" alt="" style="max-height:100px">
            <p class="profile-name">{{ Auth::user()->name }}</p>
            <p class="profile-email">{{ Auth::user()->email }}</p>
            <i id="sidebar-close" class="fa fa-times fa-2x"></i>
        </li>
        <a href="#"><li class="navbar-side-item"><i class="fa fa-home      fa-2x">&nbsp;</i>홈</li></a>
        <a href="#"><li class="navbar-side-item"><i class="fa fa-dashboard fa-2x">&nbsp;</i>요약</li></a>
        <a href="#"><li class="navbar-side-item"><i class="fa fa-pencil    fa-2x">&nbsp;</i>쓰기</li></a>
        <a href="#"><li class="navbar-side-item"><i class="fa fa-cog       fa-2x">&nbsp;</i>설정</li></a>

        <a id="logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-1x">&nbsp;</i>로그아웃</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endif
    </ul>
    <!-- 사이드바 내용 끝 -->
</nav>
<div id="overlay"></div>