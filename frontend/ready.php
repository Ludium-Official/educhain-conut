<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동

$quiz_cate = $_GET["quiz_cate"]; // 퀴즈 구분
//echo $quiz_cate;
$quiz_step = ""; // 퀴즈 단계
$quiz_number = ""; // 퀴즈 단계별 uid
$quiz_point = "0"; // 퀴즈 획득 점수. 누적.
$quiz_time = "0"; // 퀴즈 총 플레이 시간. 누적.
$quiz_ox_log = ""; // 퀴즈 정답 log
$quiz_item_x2 = "0"; // x2 아이템 사용 여부.
$quiz_item_pass = "0"; // pass 아이템 사용 여부.
$quiz_item_time = "0"; // time 아이템 사용 여부.

$cqz_cookie_value = $quiz_cate."|".$quiz_step."|".$quiz_number."|".$quiz_point."|".$quiz_time."|".$quiz_ox_log."|".$quiz_item_x2."|".$quiz_item_pass."|".$quiz_item_time;
set_cookie("cqz_q", $cqz_cookie_value, 60 * 30); // 쿠키 생성 30분
//$get_cookie_cqz_q = get_cookie("cqz_q");
//echo $md5_cert_no;
//if($member["mb_id"] == "admin") {echo $cqz_cookie_value; die();}

$g5['title'] = '퀴즈 레디';
include_once('./_head.sub.php');

//새로운 시즌 시작
if (COQUIZ_SEASON_OFF == "Y") {echo "<script>window.alert('".COQUIZ_SEASON_OFF_MSG."');location.href='".G5_APP_LOBBY."';</script>";}
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>
<?php $rand_game_bgm = rand(1,8); ?>
<?php
if (strstr($quiz_cate, "news")) {
	$quiz_cate_exp = explode( "_", $quiz_cate);
	$news_quiz_wr_9 = substr($quiz_cate_exp[1], 0, 2).".".substr($quiz_cate_exp[1], 2, 2).".".substr($quiz_cate_exp[1], 4, 2);
	
	$sql = "SELECT wr_id,wr_subject FROM 0_edu_coquiz_g5_write_read where wr_9 = '".$news_quiz_wr_9."'";
	$sql_wr_id_fetch = sql_fetch($sql);
	//echo $sql_wr_id_fetch["wr_id"];	
	
	$sql = "SELECT bf_file FROM 0_edu_coquiz_g5_board_file where bo_table = 'read' and wr_id = '{$sql_wr_id_fetch['wr_id']}'";//파일 유무
	//echo $sql;
	$quiz_file_img = sql_fetch($sql);
	//echo $quiz_file_img["bf_file"];
	
	$news_quiz_img = G5_URL."/data/file/read/".$quiz_file_img["bf_file"];
	$news_quiz_title = get_text($sql_wr_id_fetch["wr_subject"]);
	
} else if ($quiz_cate == "sisa") {
	$news_quiz_img = G5_APP_CDN_IMG."/quiz/cate/sisa.png";
	$news_quiz_title = "시사·상식";
	
} else if ($quiz_cate == "economy") {
	$news_quiz_img = G5_APP_CDN_IMG."/quiz/cate/economy.png";
	$news_quiz_title = "금융·경제";	
	
} else if ($quiz_cate == "bitcoin") {
	$news_quiz_img = G5_APP_CDN_IMG."/quiz/cate/bitcoin.png";
	$news_quiz_title = "비트코인";
	
} else if ($quiz_cate == "coinyong") {
	$news_quiz_img = G5_APP_CDN_IMG."/quiz/cate/coinyong.png";
	$news_quiz_title = "코인용어";	
	
} else {
	$news_quiz_img = G5_APP_CDN_IMG."/quiz/ready_img_n4.png";
	$news_quiz_title = "<img src='".G5_APP_CDN_IMG."/quiz/ready_txt.png'>";
}
?>
<div id="wrapper">
<div id="container">
	
	<div class="qz_ready_wrap">
		<div class="qz_ready">
			<!--
            <div><img src="<?=G5_APP_CDN_IMG?>/quiz/ready_txt.png"></div> _wrong 
			<div><img src="<?=G5_APP_CDN_IMG?>/quiz/ready_img.png"></div> _wrong
            -->
            <div><?=$news_quiz_title?></div>
			<div><img src="<?=$news_quiz_img?>"></div>
			<div><img src="<?=G5_APP_CDN_IMG?>/quiz/ready_key.png"></div>
            <div><a href="#" id="quiz_start_btn" onClick="ready_key_minus();">START</a></div>
		</div>
	</div>
    
	<div class="qz_exit_ready" id="exit_quiz_btn">
		<img src="<?=G5_APP_CDN_IMG?>/quiz/exit_black.png">
	</div>

</div>
</div>

<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>

<script>
function ready_key_minus() { // 퀴즈 선택
		document.getElementById('quiz_start_btn').setAttribute('onclick', '');
		//postMessageToApp('soundStart', {file: 'sound_0_0'});//소리
		document.getElementById('quiz_start_btn').className = "bigger"; //클래스 변경
		document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=ready_key_minus&quiz_cate=<?=$quiz_cate?>";		
}

// 그만두기 버튼
const exit_quiz_btn = document.getElementById('exit_quiz_btn');
exit_quiz_btn.addEventListener('touchstart', (event) => {
	exit_quiz_btn.className = "qz_exit_ready smaller";   // qz_exit_ready 클래스 유지
});
exit_quiz_btn.addEventListener('touchend', (event) => {  
	exit_quiz_btn.className = "qz_exit_ready bigger"; // qz_exit_ready 클래스 유지
	//postMessageToApp('soundStart', {file: 'sound_0_0'});//소리
	setTimeout(exit_quiz_result(), 50); //0.05초후 이동
});

function exit_quiz_result() {
    //if (!confirm("퀴즈를 종료하면 보상을 받을 수 없어요.\n종료하시겠습니까?")) {
        // 취소(아니오) 버튼 클릭 시 이벤트
    //} else {
        location.href="<?=G5_APP_LOBBY?>?audio_reset_v=ok";
    //}
}

function full_frame_view(value) {
	document.getElementById("iframe_new_pop").src = value;
	document.getElementById("iframe_new_pop").style.display = "block";
}

function full_frame_close() {
	//window.alert("full_frame_close");
	document.getElementById("iframe_new_pop").src = "<?=G5_APP_URL?>/none.html";
	document.getElementById("iframe_new_pop").style.display = "none";
}
</script>
<?php
include_once('./_tail.sub.php');
?>