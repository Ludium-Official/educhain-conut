<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동

if (get_cookie("cqz_q")) {// 쿠키 값 가져오기
	// 쿠키 값 가져오기
	$get_cookie_cqz_q = get_cookie("cqz_q");	

	// 쿠키 값 정리
	$get_cookie_cqz_explode = explode( "|", $get_cookie_cqz_q );	
	
	$quiz_cate = $get_cookie_cqz_explode[0]; // 퀴즈 구분
	$quiz_step = $get_cookie_cqz_explode[1]; // 퀴즈 단계
	$quiz_number = $get_cookie_cqz_explode[2]; // 퀴즈 단계별 uid
	$quiz_point = $get_cookie_cqz_explode[3]; // 퀴즈 획득 점수. 누적.
	$quiz_time = $get_cookie_cqz_explode[4]; // 퀴즈 총 플레이 시간. 누적.
	$quiz_ox_log = $get_cookie_cqz_explode[5]; // 퀴즈 정답 log
	//$quiz_ox_log = "OOOOOOOOXO"; // 퀴즈 정답 log
	$quiz_O_count = mb_substr_count($quiz_ox_log,"O");
	$quiz_O_count = (int)$quiz_O_count;
	$quiz_X_count = mb_substr_count($quiz_ox_log,"X");
	$quiz_X_count = (int)$quiz_X_count;
	$quiz_item_x2 = ""; // x2 아이템 사용 여부.
	$quiz_item_pass = ""; // pass 아이템 사용 여부.
	$quiz_item_time = ""; // time 아이템 사용 여부.
	//$quiz_point = 699;
		
	//스템이 이상할때 강제 이동	
		if ($quiz_step != 5 or $quiz_O_count > 5) {
			echo "<script>location.href='".G5_APP_LOBBY,"/?audio_reset_v=ok';</script>";die();
		}		
	
	$po_rel_table = "@quiz_".$quiz_cate;
	$result_quiz_type_v = "nomal";
	$result_detail_v = "Random Quiz";		
	
	$result_detail_v = $result_detail_v." ".time();
	
	 // 0점일때 기본 지급
	if (strstr($quiz_cate, "news")) {
		if($quiz_point == 0) {$quiz_point = 200; $quiz_result_black_none = "ok";}
	} else if ($quiz_cate == "nomal") {
		if($quiz_point == 0) {$quiz_point = 140; $quiz_result_black_none = "ok";}
	} else {
		if($quiz_point == 0) {$quiz_point = 120; $quiz_result_black_none = "ok";}	}
	
	$ins_point = insert_point($member["mb_id"], $quiz_point, $result_detail_v, $po_rel_table, $member["mb_id"], 'quiz', 0, $quiz_O_count, $quiz_time); // 포인트
	//echo $ins_point;
	if (!$ins_point or $ins_point == -1){
		//alert("퀴즈 결과 - 포인트 입력 실패",G5_APP_LOBBY);
		/*echo "<script>location.href='".G5_APP_LOBBY,"/?audio_reset_v=ok';</script>";die();*/
		/*echo "<script>swal_alert('포인트 지급 오류','관리자에게 문의하세요');</script>";*/
	}
	//if ($ins_point == -1){echo "퀴즈 결과 - 포인트 입력 실패";}
	
	//보물상자 보상
		if($quiz_point < 141) {$quiz_result_box = 1; $quiz_result_copy = "always pick the opposite :)";}
		else if ($quiz_point < 400) {$quiz_result_box = 1;$quiz_result_copy = "Just a bit more calm, let's go!";}
		else if ($quiz_point > 399 and $quiz_point < 500) {$quiz_result_box = 2;$quiz_result_copy = "Raise the score, heave-ho!";}
		else if ($quiz_point > 499 and $quiz_point < 600) {$quiz_result_box = 3;$quiz_result_copy = "Oh, nice?! Let's go!!";}
		else if ($quiz_point > 599 and $quiz_point < 700) {$quiz_result_box = 4;$quiz_result_copy = "Is this me?! Top rank? Clap clap!";}
		else if ($quiz_point > 699) {$quiz_result_box = 5;$quiz_result_copy = "I hereby appoint you as a whiz!";}	
	
	if ($quiz_result_box != 5 and $quiz_result_black_none != "ok") { // 최고등급이 아니고 1문제이상 맞췄을때 랜덤 돌리기
		$quiz_result_black = rand(1,2); // 블랙 랜덤 추출
	} else {
		$quiz_result_black = 99; // 노멀
	}
	//if ($member["mb_id"] == "kakao_95df08a29") {$quiz_result_black = 1;}

	$ins_box = insert_box($ins_point, $member["mb_id"], $quiz_result_box, 1, $result_detail_v, $member["mb_id"], 'quiz', $result_quiz_type_v); //박스 지급
	//$ins_point 는 점수 테이블 po_id
	if ($ins_box != "1"){
		$quiz_result_black = 99;
	} else if ($quiz_result_box == 5) { //최고 등급 상자일 때 업그레이드 X
		$quiz_result_black = 99;
	}
	
} else {
	//alert("퀴즈 결과 - 비정상적 접근",G5_APP_LOBBY);
	echo "<script>location.href='".G5_APP_LOBBY,"/?audio_reset_v=ok';</script>";die();	
}

$g5['title'] = '퀴즈 결과';
include_once('./_head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>

<div id="wrapper">
    <div id="container">

<?php 
if ($quiz_result_black == 1) { 

	$div_back_class = "qz_result_black_wrap";
	$qz_result_black = "qz_result_black_back";
	$qz_point_dis_v = "purple_n";
	$qz_result_text_v = " ft_c_white";
	$quiz_result_box_line = "_line";
	$qz_display_three = "ft_c_white";
	$qz_sharw_style = "_white";
	
} else {
	
	$div_back_class = "qz_result_wrap";
	$qz_result_black = "qz_result_back";
	$qz_point_dis_v = "lemon_n";
	$qz_result_text_v = "";
	$quiz_result_box_line = "";
	$qz_display_three = ""; //검정글씨
	$qz_sharw_style = "";
}
?>

	<div class="<?=$div_back_class?>">
		<div class="<?=$qz_result_black?>"><img src="<?=G5_APP_CDN_IMG?>/quiz_result_light.png" class="tada2"></div><!-- 배경/빛 -->
		<div class="qz_result_star_1"><img src="<?=G5_APP_CDN_IMG?>/quiz_result_star_1.png" class="flash"></div><!-- 배경/별 -->
		<div class="qz_result_star_2"><img src="<?=G5_APP_CDN_IMG?>/quiz_result_star_2.png" class="flash2"></div><!-- 배경/별 -->
		<div class="qz_result_star_3"><img src="<?=G5_APP_CDN_IMG?>/quiz_result_star_1.png" class="flash3"></div><!-- 배경/별 -->
		<div class="qz_result_star_4"><img src="<?=G5_APP_CDN_IMG?>/quiz_result_star_2.png" class="flash"></div><!-- 배경/별 -->

		<div class="qz_result">
			<!-- 점수 -->
			<div class="bounceIn3" style="opacity:0;">
			<?php
			for($i = 0; $i <= strlen($quiz_point) - 1; $i++){
				$cut_quiz_point = substr($quiz_point, $i, 1 );
				if ($i == 0) {$cut_quiz_margin = "class='nomargin'";} else {$cut_quiz_margin = "";}
				echo "<img src='".G5_APP_CDN_IMG."/".$qz_point_dis_v."_".$cut_quiz_point.".png' ".$cut_quiz_margin.">";			
			}
			?>
            </div>
			<div class="bounceIn3<?=$qz_result_text_v?>" style="opacity:0;"><?=$quiz_result_copy?></div>
			<!-- 보물상자 -->
			<div class="qz_result_upgrade">
            	<!-- 보물상자 -->
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_<?=$quiz_result_box?><?=$quiz_result_box_line?>.png" class="bounceIn4" style="opacity:0;">
                <?php if ($quiz_result_black == 1) { ?>
                <div class="qz_upgrade_img" id="box_upgrade_btn" onClick="document.getElementById('box_upgrade_ani_box').className = '';"><img id="box_upgrade_ani_box" src="<?=G5_APP_CDN_IMG?>/upgrade_<?=$quiz_result_box+1?>_n.png" class="flash_upgradeN"></div><!-- class="flash_upgradeN" -->
                <?php } ?>
			</div>
			<!-- 시간/정답/오답 -->
			<div class="qz_result_list">
				<ul>
					<li class="<?=$qz_display_three?>"><img src="<?=G5_APP_CDN_IMG?>/result_time.png"><br/>(<?=$quiz_time?>) Sec</li>
					<li class="<?=$qz_display_three?>"><img src="<?=G5_APP_CDN_IMG?>/result_correct.png"><br/>(<?=$quiz_O_count?>) Correct</li>
					<li class="<?=$qz_display_three?>"><img src="<?=G5_APP_CDN_IMG?>/result_wrong.png"><br/>(<?=$quiz_X_count?>) incorrect</li>
					<!-- li에 클래스 없으면 검은색컬러 텍스트 -->
				</ul>
			</div>
			<div class="qz_result_replay">
            <?php
			if (strstr($quiz_cate, "news")) {				
				
					$explode_quiz_no = explode("_",$quiz_cate);
					
					$sql_m = " select mb_news from 0_edu_coquiz_g5_member where mb_id = '{$member["mb_id"]}'";
					$result_m = sql_fetch($sql_m);					
					$update_news_v = $result_m["mb_news"]."_".$explode_quiz_no[1];		
					$sql_mm = "UPDATE 0_edu_coquiz_g5_member SET mb_news = '".$update_news_v."' WHERE mb_id = '{$member["mb_id"]}'";
					$result_mm = sql_query($sql_mm);				
				
					//오늘 뉴스레터 퀴즈 푼 횟수
					$quest_date_start_day = date('Y/m/d', time());// 시작 날자 구하기
					$quest_date_end_day = $quest_date_start_day;// 마감 날자 구하기					
					$sql = "SELECT COUNT(po_id) AS cnt FROM 0_edu_coquiz_g5_point where po_datetime between '{$quest_date_start_day} 00:00:00' and '{$quest_date_end_day} 23:59:59' AND mb_id = '".$member['mb_id']."' AND po_rel_table like '@quiz_news%'";
					//echo $sql;
					$sql_day_quiz_count = sql_fetch($sql);
					
					
					//오늘 뉴스레터 퀴즈 푼 횟수 지난 시즌 같은 날 체크
					$sql = "SELECT * FROM 0_edu_coquiz_g5_season where season_start < '{$now_ymdhis_v}' AND season_end > '{$now_ymdhis_v}'";
					$seaon_info = sql_fetch($sql);
					$old_season_no_v = $seaon_info["season_no"] - 1;
					$sql = "SELECT COUNT(po_id) AS cnt FROM 0_edu_coquiz_g5_point_{$old_season_no_v} where po_datetime between '{$quest_date_start_day} 00:00:00' and '{$quest_date_end_day} 23:59:59' AND mb_id = '".$member['mb_id']."' AND po_rel_table like '@quiz_news%'";
					//if ($member["mb_id"] == "admin") { echo $sql;}
					$old_sql_day_quiz_count = sql_fetch($sql);
					
					$final_sql_day_quiz_count = $sql_day_quiz_count["cnt"] + $old_sql_day_quiz_count["cnt"];	
					
					$sql_m_f = " select mb_news from 0_edu_coquiz_g5_member where mb_id = '{$member["mb_id"]}'";
					$result_m_f = sql_fetch($sql_m_f);
					
					if($result_m_f["mb_news"]) {
						$search_news_count = substr_count($result_m_f["mb_news"], $explode_quiz_no[1]);	
					}
					
				    if ($search_news_count > 1 or $final_sql_day_quiz_count > 1) {
					} else {
			?>		
            <a href="<?=G5_APP_URL?>/ready.php?quiz_cate=<?=$quiz_cate?>"><img src="<?=G5_APP_CDN_IMG?>/result_replay2.png"><br><span class="<?=$qz_display_three?>">Try again</span></a>
			<?php 		
                    }
           
			} else {
			?>
            <a href="<?=G5_APP_URL?>/ready.php?quiz_cate=<?=$quiz_cate?>"><img src="<?=G5_APP_CDN_IMG?>/result_replay2.png"><br><span class="<?=$qz_display_three?>">Try again</span></a>
            <?php }?>
            </div>
		</div>
	</div>
  
	<div class="section_8"><?php include_once(G5_APP_PATH.'/include/footer.php'); // 하단 네비 ?></div>

</div>
</div>
<script>

//audio_play_go_quiz('4_5', '#');
function full_frame_view(value) {
	document.getElementById("iframe_new_pop").src = value;
	document.getElementById("iframe_new_pop").style.display = "block";
}

function full_frame_close() {
	//window.alert("full_frame_close");
	document.getElementById("iframe_new_pop").src = "<?=G5_APP_URL?>/none.html";
	document.getElementById("iframe_new_pop").style.display = "none";
	//document.location.href="<?=G5_APP_URL?>/market.php";
}
</script>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
<?php
include_once('./_tail.sub.php');
?>