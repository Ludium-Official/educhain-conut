<?php
include_once('./_common.php');
//if (!$member["mb_id"]) {goto_url("/bbs/login.php");}  
$g5['title'] = '보물 상자 오픈';
include_once('./_head.sub.php');

$sql = "SELECT * FROM 0_edu_coquiz_g5_box where box_id = '".$_GET["box_id"]."' and box_open = 0";
//echo $sql; die();
$box_info = sql_fetch($sql);
//$box_info["box_type"] = 5;
//echo $box_info["mb_id"]."-".$member["mb_id"]; 
//die();
//echo $member["box"]; die();
if ($box_info["mb_id"] != $member["mb_id"]) { // 내 상자가 아니거나 이미 열림
	alert("상자 OPEN - 오류가 발생했어요",G5_APP_LOBBY);
}

/*
if ($member["box"] < 1) { // 상자가 없을 때
	alert("상자 OPEN - 회원 정보 보유 상자가 없음",G5_APP_LOBBY);
}
*/

//상자 종류에 따른 아이템 설정
switch ($box_info["box_type"]) {
  case 1:
  $mb_candy = rand(1,2);
  $mb_pie = rand(1,2);
  $item_rand = rand(1,3);
  $item_ea = 1;
  $get_cs = 3;
  break;  
	
  case 2:
  $mb_candy = rand(1,2);
  $mb_pie = rand(1,2);
  $item_rand = rand(1,3);
  $item_ea = 1;
  $get_cs = 3;
  break;  
	
  case 3:
  $mb_candy = rand(1,3);
  $mb_cookie = rand(1,3);
  $mb_pie = rand(1,3);
  $item_rand = rand(1,3);
  $item_ea = 1;
  $get_cs = 4;
  break;  
	
  case 4:
  $mb_candy = rand(1,4);
  $mb_cookie = rand(1,4);
  $mb_pie = rand(1,4);
  $item_rand = rand(1,3);
  $item_ea = 1;
  $get_cs = 4;
  break;  

  case 5:
  $mb_candy = rand(1,5);
  $mb_cookie = rand(1,5);
  $mb_pie = rand(1,5);
  $item_rand = rand(1,3);
  $item_ea = 1;
  $get_cs = 4;
  break;
  
  /*
  case 6:
  $mb_candy = rand(200,300);
  $mb_cookie = rand(20,30);
  $mb_key = rand(6,10);
  $item_rand = 3;
  $item_ea = rand(3,5);
  $get_cs = 4;
  break;
  */
}

if ($mb_candy) {
	//사탕 지급
	$ins_candy_box = insert_candy($_GET["box_id"], $member["mb_id"], $mb_candy, "Conut Box OPEN Reward", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	if ($ins_candy_box) {
	} else {
		alert("사탕 수령 - 코넛상자 오픈 보상 쿠키 지급 실패",G5_APP_LOBBY);
	}
}

if ($mb_cookie) {
	//쿠키 지급
	$ins_cookie_box = insert_cookie($_GET["box_id"], $member["mb_id"], $mb_cookie, "Conut Box OPEN Reward", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	if ($ins_cookie_box) {
	} else {
		alert("쿠키 수령 - 코넛상자 오픈 보상 쿠키 지급 실패",G5_APP_LOBBY);
	}
}


if ($mb_key) {
	//열쇠 지급
	$ins_key_box = insert_key($_GET["box_id"], $member["mb_id"], $mb_key, "Conut Box OPEN Reward", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	if ($ins_key_box) {
	} else {
		alert("키 수령 - 코넛상자 오픈 보상 열쇠 지급 실패",G5_APP_LOBBY);
	}
}

if ($mb_pie) {
	//파이 지급
	$ins_pie_box = insert_pie($_GET["box_id"], $member["mb_id"], $mb_pie, "Conut Box OPEN Reward", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	if ($ins_pie_box) {
	} else {
		alert("파이 수령 - 코넛상자 오픈 보상 파이 지급 실패",G5_APP_LOBBY);
	}
}

if ($item_rand) {
	switch ($item_rand) {
	  case 1:
	  $mb_item = "time";	  
	  $item_rand_cc = 3;
	  break;  
		
	  case 2:
	  $mb_item = "pass";
	  $item_rand_cc = 4;
	  break;  
		
	  case 3:
	  $mb_item = "x2";
	  $item_rand_cc = 5;
	  break;  
	}
	//echo $mb_item."|".$item_ea;exit;
	//아이템 지급
	$ins_item_box = insert_item($_GET["box_id"], $member["mb_id"], $mb_item, $item_ea, "Conut Box OPEN Reward", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	//$ins_item_box = insert_item($_GET["box_id"], $member["mb_id"], "pass", 1, "코넛상자 OPEN 보상", $member["mb_id"], "conutbox", "lobby_conutbox_open");
	if ($ins_item_box) {
	} else {
		alert("아이템 수령 - 코넛상자 오픈 보상 아이템 입력 실패",G5_APP_LOBBY);
	}	
}

	//개봉 박스 오픈처리
	$sql = "update 0_edu_coquiz_g5_box SET box_open = 1 where mb_id = '".$member["mb_id"]."' and box_id = ".$_GET["box_id"].""; 
	//echo $sql;
	sql_query($sql);
	//회원 박스 수량 업데이트
	$sql = "update {$g5['member_table']} SET box = box - 1 where mb_id = '".$member["mb_id"]."'";
	sql_query($sql);
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>



<div id="wrapper">
<div id="container" style="overflow:hidden;" onClick="">

	<!-- 2. 보물상자 열릴때 -->
	<div class="container_giftbox2">
		<div class="giftBox_layout3">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_light.jpg" class="flash"><!-- 빛나는 배경 -->
		</div>
		<div class="giftBox_layout2"><!-- 열린 보물상자 / giftbox_1_open.png ~ giftbox_6_open.png -->
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_<?=$box_info["box_type"]?>_open.png?ver=240305" class="bounceIn" style="opacity:0;">
		</div>
		<div class="giftBox_layout4"><!-- 물방울 -->
			<img src="<?=G5_APP_CDN_IMG?>/attend_pie.png" class="fadeInUp1" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_2.png" class="fadeInUp2" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_3.png" class="fadeInUp3" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/attend_pie.png" class="fadeInUp4" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_5.png?ver=241114" class="fadeInUp5" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_1.png" class="fadeInUp6" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_2.png" class="fadeInUp7" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_3.png" class="fadeInUp8" style="opacity:0;">
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_4.png" class="fadeInUp9" style="opacity:0;">
		</div>
	</div>
	
	<!-- 1. 보물상자 열리기전 흔들릴 때 -->
	<div class="container_giftbox fadeOut">
		<div class="giftBox_back_shake">
			<img src="<?=G5_APP_CDN_IMG?>/background_2.jpg" class="rotateBack">
		</div>
		<div class="giftBox_layout"><!-- 흔들리는 보물상자 / giftbox_1.png ~ giftbox_6.png -->
			<img src="<?=G5_APP_CDN_IMG?>/giftbox_<?=$box_info["box_type"]?>.png" class="shake_giftbox">
		</div>
	</div>
	

	<!-- 3. 보물상자 열리고나서-->
	<div class="giftbox_result fadeIn1" style="opacity:0;">
			<div class="giftbox_result_inbox">
				<div class="giftbox_layout5 bounceIn2" style="opacity:0;"><!-- 코넛 이미지 open_img_1.png ~ open_img_6.png -->
					<img src="<?=G5_APP_CDN_IMG?>/open_img_<?=$box_info["box_type"]?>.png">
				</div>          

                <div class="reward_1_n<?php if($mb_pie == "5") {echo "_over";}?> rotateIn_1"  style="opacity:0;"><!-- 파이 1  / 파이 최대치 받았을때 클래스명에 _over 붙여준다. 예) reward_1_n -> reward_1_n_over -->
					<span><?=$mb_pie?></span>
				</div>                  
                
                <div class="reward_2_n<?php if($mb_candy == "5") {echo "_over";}?> rotateIn_2"  style="opacity:0;"><!-- 캔디 -->
					<span><?=$mb_candy?></span>
				</div>
                
                <div class="reward_<?=$item_rand_cc?>_n rotateIn_3"  style="opacity:0;"><!-- 아이템 1 -->
					<span><?=$item_ea?></span>
				</div>              
              
				<?php if ($mb_cookie) { ?>
                <div class="reward_6_n<?php if($mb_cookie == "5") {echo "_over";}?> rotateIn_4"  style="opacity:0;"><!-- 쿠키 1 -->
					<span><?=$mb_cookie?></span>
				</div>                
                <?php } ?>

				<!-- 받기 버튼, 보상이 하나일때는 클래스명 get_1,보상이 두개일때는 get_2,  보상이 세개일때는 get_3, 보상이 네개일때는 get_4
				<div class="giftbox_layout8 get_<?=$get_cs?>"  style="opacity:0;">
					<a href="<?=G5_APP_LOBBY?>" onClick="postMessageToApp('soundStart', {file: 'sound_0_0'});"><img src="<?=G5_APP_CDN_IMG?>/button_lobby.png"></a>
				</div>
                -->

			</div>
	</div>
	
	


</div>
</div>
<script>	
setTimeout(next_step_1,4000);
function next_step_1() {
	document.getElementById('container').setAttribute("onClick","location.href='<?=G5_APP_LOBBY?>';postMessageToApp('soundStart', {file: 'sound_0_0'});");
}
</script>
<?php
include_once('./_tail.sub.php');
?>