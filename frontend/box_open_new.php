<?php
include_once('common.php');
//if (!$member["mb_id"]) {goto_url("/bbs/login.php");}  
$g5['title'] = '보물 상자 오픈';
include_once('head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>



<div id="wrapper">
<div id="container" style="overflow:hidden;" onClick="">

		
		<!-- 3. 보물상자 열리고나서-->
		<div class="giftbox_newUser fadeIn2" style="opacity:0;">
				<div class="giftbox_result_inbox_m">

					<div class="giftbox_newUser_txt bounceIn5" style="opacity:0;"><!-- 선물 멘트 -->
						Guess what! Conut has prepared a special gift just for <b><?=$member['mb_nick']?></b>!<br>It’s going to be a big help in enjoying COQUIZ!<img src="/0_v1_img/icon_heart.png">
					</div>
					<div class="giftbox_layout5 bounceIn6" style="opacity:0;"><!-- 코넛 이미지 -->
						<img src="<?=G5_APP_CDN_IMG?>/open_img_m.png">
					</div>          

				   <div class="hei_210px" style="position:relative;">
					  <!-- 나타났다 사라지는 8개 아이템 -->
					   <div class="" style="position:absolute;">
							
							<div class="rewardM_1 <?=$mb_pie_area?> default rotateIn_5"  style="opacity:0;">
								<span>10000</span>
							</div>            
							<div class="rewardM_2 <?=$mb_key_area?> default rotateIn_5"  style="opacity:0;">
								<span>100</span>
							</div> 
							<div class="rewardM_3 <?=$mb_roulette_area?> default rotateIn_5"  style="opacity:0;">
								<span>100</span>
							</div>            
							<div class="rewardM_4 <?=$mb_cookie_area?> default rotateIn_5"  style="opacity:0;">
								<span>10000</span>
							</div> 
							<div class="rewardM_5 <?=$mb_candy_area?> default rotateIn_6"  style="opacity:0;">
								<span>5000</span>
							</div> 
							<div class="rewardM_6 <?=$mb_time_area?> default rotateIn_6"  style="opacity:0;">
								<span>300</span>
							</div>            
							<div class="rewardM_7 <?=$mb_pass_area?> default rotateIn_6"  style="opacity:0;">
								<span>300</span>
							</div> 
							<div class="rewardM_8 <?=$mb_x2_area?> default rotateIn_6"  style="opacity:0;">
								<span>300</span>
							</div> 
						</div>
						<!-- 나타났다 사라지는 8개 아이템 -->

				 </div>
					
				</div>
		</div>
		<!-- 3. 보물상자 열리고나서-->

	

	

</div>
</div>
<script>
setTimeout(next_step_2,1000);
function next_step_2() {
	//document.getElementById('container').setAttribute("onClick","location.href='<?=G5_APP_LOBBY?>?mb_first_lobby=ok&mb_point_update_lobby=ok';");
	//파이어베이스토큰 임시
	document.getElementById('container').setAttribute("onClick","location.href='<?=G5_APP_LOBBY?>?gft_chk=ok';");
	//파이어베이스토큰 임시
	//postMessageToApp('soundStart', {file: 'ru_result'});	
	//postMessageToApp('vibrateStart', {pattern: '100,100'});
}

</script>
<?php
include_once('tail.sub.php');
?>