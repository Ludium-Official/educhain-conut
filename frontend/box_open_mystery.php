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


						
							//$mb_pie = 700;
							$mb_pie = rand(100,700);
							if ($mb_pie > 600) {$mb_pie_area = "max_1"; $result_pie_class = "rewardM_1 max_1 select";} else if ($mb_pie > 300) {$mb_pie_area = "mid_1"; $result_pie_class = "rewardM_1 mid_1 select";} else {$mb_pie_area = ""; $result_pie_class = "rewardM_1 select";}
							
							$mb_key = rand(1,5);	
							if ($mb_key > 4) {$mb_key_area = "max_2"; $result_key_class = "rewardM_2 max_2 select";} else if ($mb_key > 2) {$mb_key_area = "mid_2"; $result_key_class = "rewardM_2 mid_2 select";} else {$mb_key_area = ""; $result_key_class = "rewardM_2 select";}	
																			
							$mb_roulette = rand(1,5);
							if ($mb_roulette > 4) {$mb_roulette_area = "max_3"; $result_roulette_class = "rewardM_3 max_3 select";} else if ($mb_roulette > 2) {$mb_roulette_area = "mid_3"; $result_roulette_class = "rewardM_3 mid_3 select";} else {$mb_roulette_area = ""; $result_roulette_class = "rewardM_3 select";}
							
							$mb_cookie = rand(10,50);
							if ($mb_cookie > 40) {$mb_cookie_area = "max_4"; $result_cookie_class = "rewardM_4 max_4 select";} else if ($mb_cookie > 20) {$mb_cookie_area = "mid_4"; $result_cookie_class = "rewardM_4 mid_4 select";} else {$mb_cookie_area = ""; $result_cookie_class = "rewardM_4 select";}
							
							$mb_candy = rand(50,250);
							if ($mb_candy > 200) {$mb_candy_area = "max_5"; $result_candy_class = "rewardM_5 max_5 select";} else if ($mb_candy > 150) {$mb_candy_area = "mid_5"; $result_candy_class = "rewardM_5 mid_5 select";} else {$mb_candy_area = ""; $result_candy_class = "rewardM_5 select";}
							
							$mb_time = rand(5,10);
							if ($mb_time > 8) {$mb_time_area = "max_6"; $result_time_class = "rewardM_6 max_6 select";} else if ($mb_time > 4) {$mb_time_area = "mid_6"; $result_time_class = "rewardM_6 mid_6 select";} else {$mb_time_area = ""; $result_time_class = "rewardM_6 select";}
							
							$mb_pass = rand(5,10);
							if ($mb_pass > 8) {$mb_pass_area = "max_7"; $result_pass_class = "rewardM_7 max_7 select";} else if ($mb_pass > 4) {$mb_pass_area = "mid_7"; $result_pass_class = "rewardM_7 mid_7 select";} else {$mb_pass_area = ""; $result_pass_class = "rewardM_7 select";}
							
							$mb_x2 = rand(5,10);
							if ($mb_x2 > 8) {$mb_x2_area = "max_8"; $result_x2_class = "rewardM_8 max_8 select";} else if ($mb_x2 > 4) {$mb_x2_area = "mid_8"; $result_x2_class = "rewardM_8 mid_8 select";} else {$mb_x2_area = ""; $result_x2_class = "rewardM_8 select";}	


							//$rand_result_get = rand(1,12);
							$rand_result_get = rand(1,12);
							//$rand_result_get = 1;
							
							
							
							switch($rand_result_get) {
								
								case "1": //pie
								
									$result_get_type = "pie";
									$result_get_class = $result_pie_class;
									$result_get_ea = $mb_pie;
							
								break;
								
								case "2": //key
								
									$result_get_type = "key";
									$result_get_class = $result_key_class;
									$result_get_ea = $mb_key;
							
								break;
								
								case "3": //roulette
								
									$result_get_type = "roulette";
									$result_get_class = $result_roulette_class;
									$result_get_ea = $mb_roulette;
								
								break;
								
								case "4": //cookie
								
									$result_get_type = "cookie";
									$result_get_class = $result_cookie_class;
									$result_get_ea = $mb_cookie;
							
								break;
								
								case "5": //candy
								
									$result_get_type = "candy";
									$result_get_class = $result_candy_class;
									$result_get_ea = $mb_candy;
							
								break;								
								
								case "6": //time
								
									$result_get_type = "time";
									$result_get_class = $result_time_class;
									$result_get_ea = $mb_time;
							
								break;								
								
								case "7": //pass
								
									$result_get_type = "pass";
									$result_get_class = $result_pass_class;
									$result_get_ea = $mb_pass;
							
								break;
															
								case "8": //x2
								
									$result_get_type = "x2";
									$result_get_class = $result_x2_class;
									$result_get_ea = $mb_x2;
							
								break;
								
								case "9": //x2
								
									$result_get_type = "x2";
									$result_get_class = $result_x2_class;
									$result_get_ea = $mb_x2;
							
								break;
								
								case "10": //roulette
								
									$result_get_type = "roulette";
									$result_get_class = $result_roulette_class;
									$result_get_ea = $mb_roulette;
							
								break;								

								
								case "11": //key
								
									$result_get_type = "key";
									$result_get_class = $result_key_class;
									$result_get_ea = $mb_key;
							
								break;	
								
								case "12": //pass
								
									$result_get_type = "pass";
									$result_get_class = $result_pass_class;
									$result_get_ea = $mb_pass;
							
								break;	
										
								


																
							}
							
							
			//$_GET["box_id"] = time();
			
			if ($result_get_type == "time" or $result_get_type == "pass" or $result_get_type == "x2") {
				$result_get_type_ins = "item";
			} else {
				$result_get_type_ins = $result_get_type;
			}
			
			$insert_mystery_goods = "insert_".$result_get_type_ins;	
			
			if ($insert_mystery_goods == "insert_item") {
				$insert_mystery_goods_result = $insert_mystery_goods($_GET["box_id"], $member["mb_id"], $result_get_type, $result_get_ea, "Mystery Box OPEN Reward", $member["mb_id"], "mysterybox", "lobby_conutbox_open");
			} else {
				$insert_mystery_goods_result = $insert_mystery_goods($_GET["box_id"], $member["mb_id"], $result_get_ea, "Mystery Box OPEN Reward", $member["mb_id"], "mysterybox", "lobby_conutbox_open");
			}
			
			if ($insert_mystery_goods_result) {
			} else {
				alert("아이템 수령 - 미스터리박스 오픈 보상 아이템 입력 실패",G5_APP_LOBBY);
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
		<div class="container_giftbox3">
			<div class="giftBox_layout3">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_light_m.jpg" class="flash"><!-- 빛나는 배경 -->
			</div>
			<div class="giftBox_layout2">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_6_open.png?ver=240305" class="bounceIn" style="opacity:0;">
			</div>
			<div class="giftBox_layout4"><!-- 아이템들 -->
				<img src="<?=G5_APP_CDN_IMG?>/attend_pie.png" class="fadeInUp1" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_2.png" class="fadeInUp2" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_3.png" class="fadeInUp3" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/attend_pass.png" class="fadeInUp4" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/attend_double.png" class="fadeInUp5" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_1.png" class="fadeInUp6" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_2.png" class="fadeInUp7" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_3.png" class="fadeInUp8" style="opacity:0;">
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_object_4.png" class="fadeInUp9" style="opacity:0;">
			</div>
		</div>
		<!-- 2. 보물상자 열릴때 -->
	
	<!-- 1. 보물상자 열리기전 흔들릴 때 -->
		<div class="container_giftbox fadeOut">
			<div class="giftBox_back_shake">
				<img src="<?=G5_APP_CDN_IMG?>/background_m.jpg" class="rotateBack">
			</div>
			<div class="giftBox_layout"><!-- 흔들리는 보물상자 -->
				<img src="<?=G5_APP_CDN_IMG?>/giftbox_6.png" class="shakeswing_giftbox">
			</div>
		</div>
		
		<!-- 3. 보물상자 열리고나서-->
		<div class="giftbox_result fadeIn1" style="opacity:0;">
				<div class="giftbox_result_inbox_m">

					<div class="giftbox_layout5 bounceIn2" style="opacity:0;"><!-- 코넛 이미지 -->
						<img src="<?=G5_APP_CDN_IMG?>/open_img_m.png">
					</div>          

				   <div class="hei_240px" style="position:relative;">
					  <!-- 나타났다 사라지는 8개 아이템 -->
					   <div class="fadeOut_m" style="position:absolute;">
							<!-- 
							rewardM_1 -> 파이
							rewardM_2-> 열쇠
							rewardM_3 -> 룰렛
							rewardM_4 -> 쿠키
							rewardM_5 -> 사탕
							rewardM_6 -> 타임
							rewardM_7 -> 패스
							rewardM_8 -> X2
							최소수량 -> default
							중간수량 -> mid_1에서 mid_8까지
							최대수량 -> max_1에서 max_8까지
							추첨된 최종 큰 아이템 -> select
							예) 
							작은크기의 최소수량 파이 : rewardM_1 default
							작은크기의 최소수량 캔디 : rewardM_5 default
							작은크기의 중간수량 캔디 : rewardM_5 mid_3
							작은크기의 최대수량 캔디 : rewardM_5 max_3
							-----
							추첨된 큰크기의 최소수량 파이 : rewardM_1 select
							추첨된 큰크기의 중간수량 캔디 : rewardM_5 mid_3 select
							추첨된 큰크기의 최대수량 캔디 : rewardM_5 max_3 select
							-->
							<div class="rewardM_1 <?=$mb_pie_area?> default rotateIn_1"  style="opacity:0;">
								<span><?=$mb_pie?></span>
							</div>            
							<div class="rewardM_2 <?=$mb_key_area?> default rotateIn_1"  style="opacity:0;">
								<span><?=$mb_key?></span>
							</div> 
							<div class="rewardM_3 <?=$mb_roulette_area?> default rotateIn_1"  style="opacity:0;">
								<span><?=$mb_roulette?></span>
							</div>            
							<div class="rewardM_4 <?=$mb_cookie_area?> default rotateIn_1"  style="opacity:0;">
								<span><?=$mb_cookie?></span>
							</div> 
							<div class="rewardM_5 <?=$mb_candy_area?> default rotateIn_2"  style="opacity:0;">
								<span><?=$mb_candy?></span>
							</div> 
							<div class="rewardM_6 <?=$mb_time_area?> default rotateIn_2"  style="opacity:0;">
								<span><?=$mb_time?></span>
							</div>            
							<div class="rewardM_7 <?=$mb_pass_area?> default rotateIn_2"  style="opacity:0;">
								<span><?=$mb_pass?></span>
							</div> 
							<div class="rewardM_8 <?=$mb_x2_area?> default rotateIn_2"  style="opacity:0;">
								<span><?=$mb_x2?></span>
							</div> 
						</div>
						<!-- 나타났다 사라지는 8개 아이템 -->

						<!-- 8개의 아이템중 추첨된 하나의 아이템 -->
						<div class="<?=$result_get_class?> bounceIn_giftbox"  style="opacity:0;">
									<span><?=$result_get_ea?></span>
					   </div>
					   <!-- 8개의 아이템중 추첨된 하나의 아이템 -->
				 </div>
					
				</div>
		</div>
		<!-- 3. 보물상자 열리고나서-->

	

	

</div>
</div>
<script>
setTimeout(next_step_2,6000);
function next_step_2() {
	document.getElementById('container').setAttribute("onClick","location.href='<?=G5_APP_LOBBY?>';");
}
</script>
<?php
include_once('./_tail.sub.php');
?>