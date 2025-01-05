<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동
// 쿠키 값 가져오기
$get_cookie_cqz_q = get_cookie("cqz_q");

// 쿠키 값 정리
$get_cookie_cqz_explode = explode( "|", $get_cookie_cqz_q );
//echo $get_cookie_cqz_explode[0]."<br>";
//die();
$quiz_cate = $get_cookie_cqz_explode[0]; // 퀴즈 구분.
//echo $quiz_cate;
$quiz_step = $get_cookie_cqz_explode[1]; // 퀴즈 단계.
$quiz_number = $get_cookie_cqz_explode[2]; // 퀴즈 단계별 uid.
$quiz_point = $get_cookie_cqz_explode[3]; // 퀴즈 획득 점수. 누적.
$quiz_time = $get_cookie_cqz_explode[4]; // 퀴즈 총 플레이 시간. 누적.
$quiz_ox_log = $get_cookie_cqz_explode[5]; // 퀴즈 정답 log.

$step_quiz_item_use = $_GET["step_quiz_item_use"]; // 아이템 사용 여부
$step_quiz_item_info = $_GET["step_quiz_item_info"]; // 사용한 아이템 종류

$quiz_item_x2 = ""; // x2 아이템 사용 여부.
$quiz_item_pass = ""; // pass 아이템 사용 여부.
$quiz_item_time = ""; // time 아이템 사용 여부.

	$quiz_O_count = mb_substr_count($quiz_ox_log,"O");
	$quiz_O_count = (int)$quiz_O_count;

		if ($quiz_step > 6 or $quiz_O_count > 5) {
			echo "<script>location.href='".G5_APP_URL."/quiz_result.php'</script>";
		}

$g5['title'] = '퀴즈 플레이';
include_once('./_head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>

<?php
$sql = "SELECT * FROM coquiz_g5_write_edu_quiz where wr_id = '{$quiz_number}'";
$quiz = sql_fetch($sql);

	//초보유저 보정
	$sql_user_chobo = "SELECT COUNT(box_id) as cnt FROM 0_edu_coquiz_g5_box WHERE mb_id = '{$member["mb_id"]}'";
	$sql_user_chobo_count = sql_fetch($sql_user_chobo);		
	
	$quiz_type = rand(1,2);

if($quiz_type == "1") {$quiz_type = "ox";}
else if($quiz_type == "2") {$quiz_type = "four";} 
else if($quiz_type == "3") {$quiz_type = "first";} 

if ($_GET["step_quiz_type"]) {//시계 X2 아이템 사용시 문제 고정
	$quiz_type = $_GET["step_quiz_type"];
}

//문제 개별 이미지 있으면
$sql = "SELECT bf_file FROM coquiz_g5_board_file where bo_table = 'edu_quiz' and wr_id = '{$quiz_number}'";//파일 유무
$quiz_file_img = sql_fetch($sql);
if ($quiz_file_img["bf_file"]) {
	
	$quiz_file_img_name = "/data/file/edu_quiz/".$quiz_file_img["bf_file"];
	
} else { //문제 개별 이미지 없으면

	switch($quiz["ca_name"]){
	
		case "NFT": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/WEB3.png?ver=240122";
		break;
		
		case "WEB3": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/NFT.png?ver=240122";
		break;
		
		case "DeFi": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/DeFi.png?ver=240122";
		break;
		
		case "보안법률": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/law.png?ver=240122";
		break;
		
		case "금융경제": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/economy.png?ver=240122";
		break;
		
		case "블록체인": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/blockchain.png?ver=240122";
		break;
		
		case "비트코인": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/bitcoin.png?ver=240122";
		break;
		
		case "알트코인": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/altcoin.png?ver=240122";
		break;
		
		case "암호화폐 인물": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/cryptoin.png?ver=240122";
		break;
		
		case "역사사건": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/history.png?ver=240122";
		break;
		
		case "이더리움": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/etherium.png?ver=240122";
		break;
		
		case "코인속어": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/coinsok.png?ver=240122";
		break;
		
		case "코인용어": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/coinyong.png?ver=240122";
		break;
		
		case "투자": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/investing.png?ver=240122";
		break;
		
		case "투자거장": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/guru.png?ver=240122";
		break;
		
		case "시사상식": 
			$quiz_file_img_name = G5_APP_CDN_IMG."/quiz/cate/sisa.png?ver=240122";
		break;
	
	}

}
//문제 이미지 무조건 있음. 스타일 고정
$qbox1_class_v = "quiz_QBox";
$qbox2_class_v = "qz_question quiz_fadeInDown2";	

if ($quiz_type == "four") {
	//퀴즈 제목
	$quiz_title = $quiz["wr_subject"];
	
	//퀴즈 보기 길이
	$four_quiz_example_len = mb_strlen($quiz["wr_5"], "UTF-8");
//	echo $four_quiz_example_len;
	
	//퀴즈 보기 랜덤
	$quiz_example = explode("|", $quiz["wr_5"]);
	$quiz_example_four_len = mb_strlen($quiz["wr_5"], "UTF-8"); //보기 길이
	$quiz_example_rand = rand(0,5);

	if ($_GET["step_quiz_example_rand"]) {//시계 X2 아이템 사용시 문제 고정
	$quiz_example_rand = $_GET["step_quiz_example_rand"];
	}
	
	if ($quiz_example_rand == 0) {
		$quiz_example_1 = $quiz_example[0];
		$quiz_example_2 = $quiz_example[1];
		$quiz_example_3 = $quiz_example[2];
		$quiz_example_4 = $quiz_example[3];
		$quiz_example_case = "a";
	} else if ($quiz_example_rand == 1) {
		$quiz_example_1 = $quiz_example[1];
		$quiz_example_2 = $quiz_example[2];
		$quiz_example_3 = $quiz_example[3];
		$quiz_example_4 = $quiz_example[0];
		$quiz_example_case = "b";
	} else if ($quiz_example_rand == 2) {
		$quiz_example_1 = $quiz_example[2];
		$quiz_example_2 = $quiz_example[3];
		$quiz_example_3 = $quiz_example[0];
		$quiz_example_4 = $quiz_example[1];
		$quiz_example_case = "c";
	} else if ($quiz_example_rand == 3) {
		$quiz_example_1 = $quiz_example[3];
		$quiz_example_2 = $quiz_example[0];
		$quiz_example_3 = $quiz_example[1];
		$quiz_example_4 = $quiz_example[2];
		$quiz_example_case = "d";
	} else if ($quiz_example_rand == 4) {
		$quiz_example_1 = $quiz_example[1];
		$quiz_example_2 = $quiz_example[3];
		$quiz_example_3 = $quiz_example[0];
		$quiz_example_4 = $quiz_example[2];
		$quiz_example_case = "e";
	} else if ($quiz_example_rand == 5) {
		$quiz_example_1 = $quiz_example[2];
		$quiz_example_2 = $quiz_example[0];
		$quiz_example_3 = $quiz_example[3];
		$quiz_example_4 = $quiz_example[1];
		$quiz_example_case = "f";
	}
	//$quiz_example_case = "a";
	
} else if ($quiz_type == "ox") {
	
	//퀴즈 보기 랜덤
	$quiz_example = explode("|", $quiz["wr_5"]);
	
	if ($_GET["step_quiz_example_rand"]) { //시계 X2 아이템 사용시 문제 고정
		$quiz_example_rand = $_GET["step_quiz_example_rand"];
	} else { //시계/X2 아이템 미사용
		$quiz_example_rand = rand(0,3);
	}
	
	if ($quiz_example_rand == 0) {
		$quiz_subject_replace = $quiz_example[0];
		$quiz_example_case = "a";
	} else if ($quiz_example_rand == 1) {
		$quiz_subject_replace = $quiz_example[1];
		$quiz_example_case = "b";
	} else if ($quiz_example_rand == 2) {
		$quiz_subject_replace = $quiz_example[2];
		$quiz_example_case = "c";
	} else if ($quiz_example_rand == 3) {
		$quiz_subject_replace = $quiz_example[2];
		$quiz_example_case = "d";
	}	
	
	
	//퀴즈 제목
	$quiz_title = str_replace("***", "<strong style='font-size:20px;'>[<span id='ox_exam_v'>".$quiz_subject_replace."</span>]</strong>" ,$quiz["wr_2"]);
	
} else if ($quiz_type == "first") {
	
	//초성 보기
	$quiz_example = $quiz["wr_4"];
	
	//초성 길이
	$quiz_example_len = mb_strlen($quiz_example, "utf-8");
	//초성 길이대로 X로 치환
	for ($x = 1; $x <= $quiz_example_len; $x++) {
		$quiz_correct_hidden = $quiz_correct_hidden."?";
	}
	//퀴즈 제목
	$quiz_title = str_replace("***", "<strong style='font-size:20px;'>{$quiz_correct_hidden}</strong>" ,$quiz["wr_1"]);	
	
	$quiz_example_case = "a";
	
}
?>
<!-- 아이템 -->		
	<div id="item_wrap" style="display:none;"> <!-- 불투명 블랙배경 -->
		<div class="item_box"><!-- 컨텐츠 전체박스 -->			
			<div class="item_img"><img src="" class="" id="item_use_img"></div>
			<div class="item_txt" style="opacity:0;" id="item_use_text"></div>
		</div>
	</div>			
<!-- 아이템 -->

<!-- 아이템
		    <img src="/app/img/quiz/item_time.png" class="time">			
			<img src="/app/img/quiz/item_pass.png" class="pass">
			<div class="item_txt" style="opacity:0;">패스 아이템 사용</div>
		    <img src="/app/img/quiz/item_double.png" class="double"></div>
			<div class="item_txt" style="opacity:0;">X2 아이템 사용</div>
 아이템 -->


<div id="wrapper">
<div id="container">

	<!-- 제한시간.점수 -->
	<div class="top_info">
		<ul>
			<li><div><span id="quiz_time_last_v"><?=(int)$quiz_time?>S</span></div></li>
			<li><div><span id="quiz_point_last_v"><?=(int)$quiz_point?>P</span></div></li>
		</ul>
	</div>
	
	<div id="quiz_layout">
			<!-- 남은 시간 -->
			<ul class="qz_time_txt">
				<li class="fadeIn_time" id="layout_qz_time_step"><span><?=$quiz_step?></span> / 5</li>
				<li class="fadeIn_time" id="layout_qz_time_sec"><input type="text" id="quiz_play_count" value="20">S</li>                
			</ul>
			<div class="qz_time_bar fadeIn_time" id="layout_qz_time_bar">
				<!-- 달리는 코넛 - 클래스명  qz_cunut_100부터 qz_cunut_0까지 .. qz_cunut_100, qz_cunut_95, qz_cunut_90.... -->
				<div id="quiz_run_conut" class="qz_conut run_conut qz_cunut_100"><img src="<?=G5_APP_CDN_IMG?>/quiz_conut.png" alt="conut"></div>
				<span id="quiz_timebar" style="width:100%;"></span>
			</div>

			<div class="<?=$qbox1_class_v?>" id="layout_qz_title_img_div"><!--이미지 없을때 클래스 noimg_line 추가-->
				<!-- 이미지 -->
				<?php if($quiz_file_img_name) { ?><div class="qz_title_img yscale2" style="opacity:0;" id="layout_qz_img_div"><img src="<?=$quiz_file_img_name?>"></div><? } ?>
				<!-- 질문 내용/이미지 없을때 클래스 noimg_txt 추가 -->
				<div class="<?=$qbox2_class_v?>" style="opacity:0;" id="layout_qz_title_div"><?=$quiz_title?></div>
			</div>

				<?php if ($quiz_type == "four") { 
				if(30 > $quiz_example_four_len) {$four_exam_class="qz_answer";} else {$four_exam_class="qz_answer4";} // 보기 길이에 따라 변경				
				?>
                <!-- 4지선다 답변 2 X 2 default : 노란테두리, select : 노란배경, select_correct : 선택 후 정답, select_wrong : 선택 후 오답-->
				<ul class="<?=$four_exam_class?>">
					<li class="quiz_fadeInRight1" style="opacity:0;" id="quiz_four_ex_class_1"><div><img id="quiz_example_1_blit" src="" ></div><a href="#" class="default" onClick="quiz_example_select('1');" id="quiz_example_1"><span><?=$quiz_example_1?></span></a></li>
					<li class="quiz_fadeInLeft1" style="opacity:0;" id="quiz_four_ex_class_2"><div><img id="quiz_example_2_blit" src="" ></div><a href="#" class="default" onClick="quiz_example_select('2');" id="quiz_example_2"><span><?=$quiz_example_2?></span></a></li>
					<li class="quiz_fadeInRight2" style="opacity:0;" id="quiz_four_ex_class_3"><div><img id="quiz_example_3_blit" src="" ></div><a href="#" class="default" onClick="quiz_example_select('3');" id="quiz_example_3"><span><?=$quiz_example_3?></span></a></li>
					<li class="quiz_fadeInLeft2" style="opacity:0;" id="quiz_four_ex_class_4"><div><img id="quiz_example_4_blit" src="" ></div><a href="#" class="default" onClick="quiz_example_select('4');" id="quiz_example_4"><span><?=$quiz_example_4?></span></a></li>
				</ul>
				<?php } else if ($quiz_type == "ox") { ?>
				<!-- OX 답변 default : 노란테두리, select : 노란배경, select_correct : 선택 후 정답, select_wrong : 선택 후 오답 -->
				<ul class="qz_answer_ox">
					<li class="quiz_fadeInRight1" style="opacity:0;" id="quiz_ox_ex_class_1"><div><img id="quiz_example_1_blit" src="" ></div><a href="#" class="select_correct" onClick="quiz_example_select('1');" id="quiz_example_1"><span>O</span></a></li>
					<li class="quiz_fadeInLeft1" style="opacity:0;" id="quiz_ox_ex_class_2"><div><img id="quiz_example_2_blit" src="" ></div><a href="#" class="select_wrong"onClick="quiz_example_select('2');" id="quiz_example_2"><span>X</span></a></li>
				</ul>
                <?php } else if ($quiz_type == "first") { ?>
				<!-- 초성 퀴즈 - 초성 최대 8자 -->
				<div class="qz_initial quiz_fadeInDown6"  style="opacity:0;" id="quiz_first_ex_class_1">
                	<?php
					$quiz_example_len = mb_strlen($quiz_example, "UTF-8");
					//echo $quiz_example_len;
					for ($i = 0; $i < $quiz_example_len; $i++) {	
						$initial_id = "initial_len_cut_".$i;	
						echo "<span id='".$initial_id."'>".iconv_substr($quiz["wr_4"], $i, 1, "utf-8")."</span> ";
					}
					?>
                </div>

				<div class="qz_initial_input quiz_fadeInDown7"  style="opacity:0;" id="quiz_first_ex_class_2">
					<ul>
						<li><input type="text" placeholder="초성을 보고 정답을 입력하세요." id="qz_initial_answer"></input><div><img id="quiz_example_1_blit" src="" ></div></li>
						<li><button id="initial_submit" onClick="quiz_example_select('qz_initial')">GO</button></li>
					</ul>
				</div>
                <?php } ?>
				
			<!-- 보유아이템 -->
            <?php

			if ($step_quiz_item_use == "ok") { // 아이템 사용시 사용 제한
				$quiz_item1_onclick_event = "#";
				$quiz_item2_onclick_event = "#";
				$quiz_item3_onclick_event = "#";
				if ($step_quiz_item_info == "pass") {$quiz_item1_class_name = "select";} else {$quiz_item1_class_name = "default";}
				if ($step_quiz_item_info == "time") {$quiz_item2_class_name = "select";} else {$quiz_item2_class_name = "default";}
				if ($step_quiz_item_info == "x2") {$quiz_item3_class_name = "select";} else {$quiz_item3_class_name = "default";}
				
				
				$quiz_item_unmove_class_v = " unmove";
					

			} else {
				$quiz_item1_onclick_event = "item_use_quiz('pass');";
				$quiz_item1_class_name = "default";
				
				$quiz_item2_onclick_event = "item_use_quiz('time');";
				$quiz_item2_class_name = "default";
				
				$quiz_item3_onclick_event = "item_use_quiz('x2');";
				$quiz_item3_class_name = "default";
			}
			if ((int)$member["mb_pass"] < 1) {$quiz_item1_onclick_event = "#";}
			if ((int)$member["mb_time"] < 1) {$quiz_item2_onclick_event = "#";}
			if ((int)$member["mb_x2"] < 1) {$quiz_item3_onclick_event = "#";}

			?>
			<ul class="qz_item"><!-- a태그안에 class명 - 선택안됐을때/default, 선택/select -->
				<li class="quiz_fadeInDown3" style="opacity:0;" id="quiz_item_class_1"><a href="#" class="<?=$quiz_item1_class_name?><?=$quiz_item_unmove_class_v?>" onClick="<?=$quiz_item1_onclick_event?>" id="quiz_item_ahref_1"><?=$member["mb_pass"]?></a></li><!-- 움직이지 않는 아이콘은 a태그에 unmove 클래스 추가 -->
				<li class="quiz_fadeInDown4" style="opacity:0;" id="quiz_item_class_2"><a href="#" class="<?=$quiz_item2_class_name?><?=$quiz_item_unmove_class_v?>" onClick="<?=$quiz_item2_onclick_event?>" id="quiz_item_ahref_2"><?=$member["mb_time"]?></a></li><!-- 움직이지 않는 아이콘은 a태그에 unmove 클래스 추가 -->
				<li class="quiz_fadeInDown5" style="opacity:0;" id="quiz_item_class_3"><a href="#" class="<?=$quiz_item3_class_name?><?=$quiz_item_unmove_class_v?>" onClick="<?=$quiz_item3_onclick_event?>" id="quiz_item_ahref_3"><?=$member["mb_x2"]?></a></li><!-- 움직이지 않는 아이콘은 a태그에 unmove 클래스 추가 -->
			</ul>
		
		</div>

	<!-- 나가기 버튼 -->
	<div class="qz_exit">
		<img src="<?=G5_APP_CDN_IMG?>/quiz/exit_orange.png" onClick="exit_quiz_result();">
	</div>
    <input type="hidden" id="quiz_count_stop"> <!--답안 선택 후 정지 -->

</div>
</div>

<!-- 정답입니다. 시작 -->
<div class="" id="quiz_correct"></div><!-- 내려갈때는 클래스명 quiz_down -->
<!-- 정답입니다. 끝 -->

<script>
function start_quiz() { // 퀴즈시작 카운트
	
//var i = 300;
var time_count = 20;

//time_count = (time_count - 0.1).toFixed(1);
//window.alert(time_count);
	
    if (time_count == 20) {
		
        //i = 290;
        var quiz_play_count = document.getElementById("quiz_play_count");  
        var quiz_timebar = document.getElementById("quiz_timebar");
		var quiz_count_stop = document.getElementById("quiz_count_stop");
		var quiz_run_conut = document.getElementById("quiz_run_conut");
        var quiz_timebar_width = 100;
        var start_quiz_Interval = setInterval(frame,1000);
		
        function frame() {
            if (quiz_timebar_width == 0) {
				clearInterval(start_quiz_Interval);
				quiz_play_count.value = time_count;
				document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_quiz_event.php?type_v=quiz_select&quiz_type=<?=$quiz_type?>&quiz_example_case=<?=$quiz_example_case?>&quiz_select_value=none&quiz_play_count=" + document.getElementById("quiz_play_count").value + "&quiz_uid=<?=$quiz_number?>"+ "&quiz_cate=<?=$quiz_cate?>";
							
			} else if (quiz_count_stop.value == "stop") {
                clearInterval(start_quiz_Interval);
                quiz_play_count.value = time_count; 
            } else {                               
				time_count = time_count - 1;  
				quiz_timebar_width = quiz_timebar_width - 5;
                quiz_timebar.style.width = quiz_timebar_width + "%"; 
				quiz_play_count.value = time_count;
				
				quiz_run_conut.className = "qz_conut run_conut qz_cunut_" + quiz_timebar_width;
            }
        }
						
    }
	
}


function quiz_example_select(select_value) { // 퀴즈 선택
	//퀴즈 선택시 아이템 사용 금지
	document.getElementById("quiz_item_ahref_1").setAttribute('onClick','#');
	document.getElementById("quiz_item_ahref_2").setAttribute('onClick','#');
	document.getElementById("quiz_item_ahref_3").setAttribute('onClick','#');

	if (document.getElementById("quiz_count_stop").value != "stop") { //최초 실행
		if (select_value == "qz_initial") { //초성퀴즈
			select_value = document.getElementById("qz_initial_answer").value;
		} else {
			var quiz_example_id = "quiz_example_" + select_value;	
			document.getElementById(quiz_example_id).className = "select";
		}
		document.getElementById("quiz_count_stop").value = "stop";
		document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_quiz_event.php?type_v=quiz_select&quiz_type=<?=$quiz_type?>&quiz_example_case=<?=$quiz_example_case?>&quiz_select_value=" + select_value + "&quiz_play_count=" + document.getElementById("quiz_play_count").value + "&quiz_uid=<?=$quiz_number?>&step_quiz_item_info=<?=$step_quiz_item_info?>" + "&quiz_cate=<?=$quiz_cate?>";
	} 	
}

function hide_quiz() {
	document.getElementById("layout_qz_time_step").className = "quiz_fadeOutLeft1";
	document.getElementById("layout_qz_time_sec").className = "quiz_fadeOutLeft1";
	document.getElementById("layout_qz_time_bar").className = "qz_time_bar quiz_fadeOutLeft1";	
	
	document.getElementById("layout_qz_title_img_div").className = "<?=$qbox1_class_v?> quiz_fadeOutLeft1";		
	<?php if($quiz_file_img_name) { ?>
	document.getElementById("layout_qz_img_div").className = "qz_title_img yscale2 quiz_fadeOutLeft1";
	document.getElementById("layout_qz_title_div").className = "qz_question quiz_fadeOutLeft1";
	<?php } else { ?>
	document.getElementById("layout_qz_title_div").className = "qz_question quiz_fadeOutLeft1 noimg_txt";
	<?php } ?>
	
	<?php if ($quiz_type == "four") { ?>
	//4지선다
	document.getElementById("quiz_four_ex_class_1").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_four_ex_class_2").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_four_ex_class_3").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_four_ex_class_4").className = "quiz_fadeOutRight1";
	<?php } else if ($quiz_type == "ox") { ?>
	//OX
	document.getElementById("quiz_ox_ex_class_1").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_ox_ex_class_2").className = "quiz_fadeOutRight1";
	<?php } else if ($quiz_type == "first") { ?>
	//초성
	document.getElementById("quiz_first_ex_class_1").className = "qz_initial quiz_fadeOutRight1";
	document.getElementById("quiz_first_ex_class_2").className = "qz_initial_input quiz_fadeOutRight1";
	<?php } ?>
	document.getElementById("quiz_item_class_1").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_item_class_2").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_item_class_3").className = "quiz_fadeOutRight1";
	document.getElementById("quiz_correct").className = "quiz_down";
}

function action_next_quiz() {
	setTimeout(function () {hide_quiz();}, 2500);
	
	setTimeout("location.href='<?=G5_APP_URL?>/go.php'",3000);
}

function action_quiz_result() {
	setTimeout("location.href='<?=G5_APP_URL?>/quiz_result.php'",3000);
}

function exit_quiz_result() {
    swal_alert('Do you want to leave?', '', 'y', '<?=G5_APP_LOBBY?>?audio_reset_v=ok');
}

function cookie_error_alert() {
	swal_alert('앗!','퀴즈를 푸는 중에 앱을 나가면 안돼요');
	setTimeout("location.href='<?=G5_APP_LOBBY?>/?audio_reset_v=ok';",2000);
}

//$(document).ready(function(){
//});
window.onload = function(){
	
	<?php if (empty($get_cookie_cqz_q)) {?>//쿠키값이 없으면 로비로 이동 
	cookie_error_alert();
	<?php } else { 
	
if ($step_quiz_item_info == "time") { //식{ 아이템 시간 10초 정지		
			

			$start_count_time_v = 11500;						

} else {	
	

			$start_count_time_v = 1500;		

	
}
		
	
	?>
	setTimeout(function () {start_quiz();}, <?=$start_count_time_v?>);
	<?php } ?>
	
};

function item_use_quiz(item_v) {
	
	  document.getElementById("quiz_count_stop").value = "stop"; // 시간 정지
	
      switch (item_v) {
		case 'pass':
		//postMessageToApp('soundStart', {file: 'sound_quiz_pass'});
		document.getElementById("quiz_item_ahref_1").className = "select";
		document.getElementById("item_use_img").src = "<?=G5_APP_CDN_IMG?>/quiz/item_pass.png";
		document.getElementById("item_use_img").className = "pass";
		document.getElementById("item_use_text").innerHTML = "Pass to the next quiz";
		document.getElementById("item_wrap").style.display = "block";
		document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_quiz_event.php?type_v=quiz_item_use&step_quiz_item_info=pass&quiz_cate=<?=$quiz_cate?>";
		setTimeout("location.href='<?=G5_APP_URL?>/go.php?step_quiz_item_use=ok&step_quiz_item_info=pass'",2000);
        break;
		  
        case 'time':
		//postMessageToApp('soundStart', {file: 'sound_quiz_time'});
		document.getElementById("item_use_img").src = "<?=G5_APP_CDN_IMG?>/quiz/item_time.png";
		document.getElementById("item_use_img").className = "time";
		document.getElementById("item_use_text").innerHTML = "Pause time";
		document.getElementById("item_wrap").style.display = "block";
		document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_quiz_event.php?type_v=quiz_item_use&step_quiz_item_info=time&quiz_cate=<?=$quiz_cate?>";
		setTimeout("location.href='<?=G5_APP_URL?>/quiz.php?step_quiz_item_use=ok&step_quiz_item_info=time&step_quiz_type=<?=$quiz_type?>&step_quiz_example_rand=<?=$quiz_example_rand?>'",2000);
        break;
		  
		case 'x2':
		//postMessageToApp('soundStart', {file: 'sound_quiz_x2'});
		document.getElementById("item_use_img").src = "<?=G5_APP_CDN_IMG?>/quiz/item_double.png";
		document.getElementById("item_use_img").className = "double";
		document.getElementById("item_use_text").innerHTML = "Double points";
		document.getElementById("item_wrap").style.display = "block";
		document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_quiz_event.php?type_v=quiz_item_use&step_quiz_item_info=x2&quiz_cate=<?=$quiz_cate?>";
		setTimeout("location.href='<?=G5_APP_URL?>/quiz.php?step_quiz_item_use=ok&step_quiz_item_info=x2&step_quiz_type=<?=$quiz_type?>&step_quiz_example_rand=<?=$quiz_example_rand?>'",2000);
        break;			  
		  
        default:
        break;
      }	
	  
}

</script>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame"  style="display:none;"></iframe>
<?php
include_once('./_tail.sub.php');
?>