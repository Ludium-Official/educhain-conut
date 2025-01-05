<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동

// 쿠키 값 가져오기
$get_cookie_cqz_q = get_cookie("cqz_q");

// 쿠키 값 정리
$get_cookie_cqz_explode = explode( "|", $get_cookie_cqz_q );


$quiz_cate = $get_cookie_cqz_explode[0]; // 퀴즈 구분
//echo $quiz_cate;

//퀴즈 uid 뽑기
$sql = "SELECT * FROM coquiz_g5_write_edu_quiz where wr_6 = '승인' ORDER BY RAND() LIMIT 1";

$row = sql_fetch($sql);
//echo $row['wr_id']." ".$row['ca_name'];

if($get_cookie_cqz_explode[1] == "") {$get_cookie_cqz_explode[1] = 1;} //처음
else if ($_GET["step_quiz_item_use"] == "ok" and $_GET["step_quiz_item_info"] == "pass"){$get_cookie_cqz_explode[1] = $get_cookie_cqz_explode[1];} //패스 아이템 사용 시
else {$get_cookie_cqz_explode[1] = $get_cookie_cqz_explode[1] +1;} //보통
$quiz_step = $get_cookie_cqz_explode[1]; // 퀴즈 단계
$quiz_number = $row['wr_id']; // 퀴즈 단계별 uid

$quiz_point = $get_cookie_cqz_explode[3]; // 퀴즈 획득 점수. 누적.
$quiz_time = $get_cookie_cqz_explode[4]; // 퀴즈 총 플레이 시간. 누적.
$quiz_ox_log = $get_cookie_cqz_explode[5]; // 퀴즈 정답 log

$quiz_item_x2 = ""; // x2 아이템 사용 여부.
$quiz_item_pass = ""; // pass 아이템 사용 여부.
$quiz_item_time = ""; // time 아이템 사용 여부.

	$quiz_O_count = mb_substr_count($quiz_ox_log,"O");
	$quiz_O_count = (int)$quiz_O_count;

		if ($get_cookie_cqz_explode[1] > 5 or $quiz_O_count > 4) {
			echo "<script>location.href='".G5_APP_URL."/quiz_result.php'</script>";
		}


// 쿠키 값 저장
$cqz_cookie_value = $quiz_cate."|".$quiz_step."|".$quiz_number."|".$quiz_point."|".$quiz_time."|".$quiz_ox_log."|".$quiz_item_x2."|".$quiz_item_pass."|".$quiz_item_time;
//echo $cqz_cookie_value."<br>";
set_cookie("cqz_q", $cqz_cookie_value, 60 * 30); // 쿠키 생성 10분

$g5['title'] = '퀴즈 플레이 전 카테고리';
include_once('./_head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>

<div id="wrapper">
<div id="container">
	
	<!-- 배경효과 -->
	<div class="qz_go_back">
		<div class="img"></div>
	</div>

	<!-- 문제 장르 -->
	<div class="qz_go_wrap">
			<div class="qz_go">
				<div>Quiz (<?=$get_cookie_cqz_explode[1]?>)</div>
				<div><!--<a href="<?=G5_APP_URL?>/quiz.php">--><img src="<?=G5_APP_CDN_IMG?>/quiz/go_img.png" class="bounceIn3"><!--</a>--></div>
				<div><span><?=$row['ca_name']?></span></div>
			</div>
		</div>

</div>
</div>
<script>
function cookie_error_alert() {
	swal_alert('앗!','퀴즈를 푸는 중에 앱을 나가면 안돼요');
	setTimeout("location.href='<?=G5_APP_LOBBY?>/?audio_reset_v=ok';",2000);
}

window.onload = function(){
	<?php if (empty($get_cookie_cqz_q)) {?>//쿠키값이 없으면 로비로 이동 
	cookie_error_alert();
	<?php } else { ?>
	setTimeout("location.href='<?=G5_APP_URL?>/quiz.php?step_quiz_item_use=<?=$_GET["step_quiz_item_use"]?>&step_quiz_item_info=<?=$_GET["step_quiz_item_info"]?>'",1200);
	<?php } ?>
};

</script>
<?php
include_once('./_tail.sub.php');
?>