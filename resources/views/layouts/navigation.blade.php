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

<nav class="navbar sticky-top navbar-light bg-faded" role="navigation">
    <button class="navbar-toggler" id="navbarSideButton" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- 사이드바 내용 시작 -->
    <ul class="navbar-side reveal" id="navbarSide">
        <li id="profile" class="navbar-side-item">
            <img src="https://github.com/hwiVeloper.png" alt="" style="max-height:100px">
            <p class="profile-name">아무개</p>
            <p class="profile-email">amoo-gae@gmail.com</p>
            <i id="sidebar-close" class="fa fa-times fa-2x"></i>
        </li>
        <li class="navbar-side-item"><a href="#"><i class="fa fa-home      fa-2x">&nbsp;</i>홈</a></li>
        <li class="navbar-side-item"><a href="#"><i class="fa fa-dashboard fa-2x">&nbsp;</i>요약</a></li>
        <li class="navbar-side-item"><a href="#"><i class="fa fa-pencil    fa-2x">&nbsp;</i>쓰기</a></li>
        <li class="navbar-side-item"><a href="#"><i class="fa fa-cog       fa-2x">&nbsp;</i>설정</a></li>
    </ul>
    <!-- 사이드바 내용 끝 -->
</nav>
<div id="overlay"></div>