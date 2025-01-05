	<style>
		/* 5 더보기 메뉴 */
		.bottom_NAvi_n3 li:nth-child(5) span {
				display:inline-block;
				width:34px;height:100%;
				background:url('/0_edu_img/menu_more.png?ver=<?=time()?>') center center no-repeat;
				background-size:auto 34px;
		}
		.bottom_NAvi_n3 li:nth-child(5).move span {
				background:url('/0_edu_img/menu_more_over.png?ver=<?=time()?>') center center no-repeat;
				background-size:auto 34px;
				-webkit-animation-name:moveIcon;animation:moveIcon 0.2s linear forwards;
		}
		.bottom_NAvi_n3 li:nth-child(5).endmove span {
				background:url('/0_edu_img/menu_more_over.png?ver=<?=time()?>') center center no-repeat;
				background-size:auto 34px;
				-webkit-animation-name:overIcon2;animation:overIcon2 0.2s linear forwards;
		}
		.bottom_NAvi_n3 li:nth-child(5).over span {
				display:inline-block;
				width:34px;height:100%;
				background:url('/0_edu_img/menu_more_over.png?ver=<?=time()?>') center center no-repeat;
				background-size:auto 34px;
		}
	</style>
	<!-- 하단 메뉴 -->
    <!--
	<ul class="bottom_menu">
		<li><a href="<?=G5_APP_LOBBY?>"><img src="/app/img/bottom_lobby.png" alt="로비 가기"></a></li>
		<li><img src="/app/img/bottom_play.png" alt="플레이" onClick="audio_play_go_quiz();"></li>
		<li><a href="<?=G5_APP_URL?>/market.php"><img src="/app/img/bottom_market.png" alt="상점 가기"></a></li>
	</ul>
    -->
    
	<!-- 하단 메뉴 -->
    <?php
	if($g5['title'] == "퀴즈 결과" or $g5['title'] == "퀴즈 레디") {
		$audio_reset_v_link = "?audio_reset_v=ok";
	}
	?>
	<ul class="bottom_NAvi_n3">
            <!-- 롤오버했을 때 동적효과 클래스는 "move", 해당페이지 이동했을 때 클래스는 "over"-->
			<li <?php if($g5['title'] == "로비"){echo "class='over'";}?> id="footer_navi_lobby_btn"><div class="grayCircle"></div><span></span></li>
			<li <?php if($g5['title'] == "파이샵" or $g5['title'] == "파이샵_리스트" or $g5['title'] == "파이샵_상세" or $g5['title'] == "파이샵_상세_코인"){echo "class='over'";}?> id="footer_navi_point_btn"><div class="grayCircle"></div><span></span></li>
			<li id="footer_navi_quiz_btn">
				<!-- 아래 퍼져나가는 배경원은 보이지 않다가,  onmouseover="javascript:showPlay()"로 나타남 / common.js 맨밑에 정의되어 있음 -->
				<div class="quiz_play" id="quizPlay_ani" style="display:none;"><img src="<?=G5_APP_CDN_IMG?>/play_back_4.png" alt="quiz"></div><!-- 퍼져나가는 배경 원 -->
				<div class="quiz_play_center"><img src="<?=G5_APP_CDN_IMG?>/play_back_5.png" alt="quiz"></div><!-- 배경 원 -->
                <div class="play_conut"><img src="<?=G5_APP_CDN_IMG?>/play_conut.png" alt="quiz" style="opacity:0;"><div><!-- 코넛캐릭터 -->
				<div class="play_quiz"><img src="<?=G5_APP_CDN_IMG?>/play_quiz.png" alt="quiz" style="opacity:0;"><div><!-- quiz 이미지 -->
			</li>
			<!-- 롤오버했을 때 동적효과 클래스는 "move", 해당페이지 이동했을 때 클래스는 "over"-->
			<li <?php if($g5['title'] == "상점"){echo "class='over'";}?> id="footer_navi_market_btn"><div class="grayCircle"></div><span></span></li>
			<li <?php if($g5['title'] == "혜택" or $g5['title'] == "쿠폰" or $g5['title'] == "친구 초대" or $g5['title'] == "룰렛" or $g5['title'] == "예측"  or $g5['title'] == "퀘스트" or strstr($g5_head_title,'코퀴즈 이벤트') or strstr($g5_head_title,'코퀴즈 예측') or strstr($g5_head_title,'지난 코넛 다시 보기') ){echo "class='over'";}?> id="footer_navi_more_btn"><div class="grayCircle"></div><span></span></li>
     </ul>
<script>
//로비
const footer_navi_lobby_btn = document.getElementById('footer_navi_lobby_btn');
footer_navi_lobby_btn.addEventListener('touchstart', (event) => {
	footer_navi_lobby_btn.className = "move";  
});
footer_navi_lobby_btn.addEventListener('touchend', (event) => {  
  footer_navi_lobby_btn.className = "endmove"; //클래스 변경
  postMessageToApp('soundStart', {file: 'sound_0_0'});//소리
 <?php
 	if($member["mb_nick"] == "이잣" or $member["mb_id"] == "test_coquiz") {
 ?>
  setTimeout("location.href='<?=G5_APP_LOBBY?><?=$audio_reset_v_link?>';", 250); //0.25초후 이동
 <?php } else { ?>
  setTimeout("location.href='<?=G5_APP_LOBBY?><?=$audio_reset_v_link?>';", 250); //0.25초후 이동
 <?php } ?>
  
});

// 점수
const footer_navi_point_btn = document.getElementById('footer_navi_point_btn');
footer_navi_point_btn.addEventListener('touchstart', (event) => {
	footer_navi_point_btn.className = "move";  
});
footer_navi_point_btn.addEventListener('touchend', (event) => {
  footer_navi_point_btn.className = "endmove"; //클래스 변경
  postMessageToApp('soundStart', {file: 'sound_0_0'});
  setTimeout("location.href='<?=G5_APP_URL?>/pieshop.php<?=$audio_reset_v_link?>';", 250); //0.25초후 이동  
});

//중앙 퀴즈
const footer_navi_quiz_btn = document.getElementById('footer_navi_quiz_btn');
footer_navi_quiz_btn.addEventListener('touchstart', (event) => {
	document.getElementById('quizPlay_ani').style.display = 'block';
});
footer_navi_quiz_btn.addEventListener('touchend', (event) => {  
  postMessageToApp('soundStart', {file: 'sound_7_1'});
  location.href='<?=G5_APP_URL?>/ready.php?quiz_cate=nomal';
});

//우측 상점
const footer_navi_market_btn = document.getElementById('footer_navi_market_btn');
footer_navi_market_btn.addEventListener('touchstart', (event) => {
	footer_navi_market_btn.className = "move";  
});
footer_navi_market_btn.addEventListener('touchend', (event) => {
  footer_navi_market_btn.className = "endmove"; //클래스 변경
  postMessageToApp('soundStart', {file: 'sound_0_0'});
  setTimeout("location.href='<?=G5_APP_URL?>/market.php<?=$audio_reset_v_link?>';", 250); //0.25초후 이동  
});

//우측 더보기
const footer_navi_more_btn = document.getElementById('footer_navi_more_btn');
footer_navi_more_btn.addEventListener('touchstart', (event) => {
	footer_navi_more_btn.className = "move";  
});
footer_navi_more_btn.addEventListener('touchend', (event) => {
  footer_navi_more_btn.className = "endmove"; //클래스 변경
  postMessageToApp('soundStart', {file: 'sound_0_0'});
  setTimeout("location.href='<?=G5_APP_URL?>/benefit.php<?=$audio_reset_v_link?>';", 250); //0.25초후 이동  
});

</script>