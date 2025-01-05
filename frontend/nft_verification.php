<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동
$g5['title'] = 'nft_verification';
include_once('./_head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>	
<!-- 설정 컨텐츠 시작 -->
	<div id="wallet_wrap2">
		<div class="wallet_box2"><!-- 컨텐츠 전체박스 -->

			
		<div class="wallet_inbox2">
						<ul>
						    <li>
                            <?php
							if ($member["nft_c1"] > 0 or $member["nft_c2"] > 0 or $member["nft_c3"] > 0) { 
							?>                            
                            <img src="member_conut/740/<?=$member["mb_id"]?>.png?ver=<?=time()?>">
                            <?php
							} else {
							?>
                            <a href="#"><img src="<?=G5_APP_CDN_IMG?>/nft_normal/none_nft.png"></a>
                            <?php
							} 
							?>
                            </li>
							<!-- 활성화  btn_reward, 비활성화 btn_reward_disable, 활성화일때는 이미지태그에 swing_mistery클래스 추가-->
							<li>
                            <?php
							if ($member["nft_c2"] > 0 or $member["nft_c3"] > 0) { 
							?>
                            <a href="#" class="btn_reward"><img src="<?=G5_APP_CDN_IMG?>/nft_c2.png"> EDU rewards X2 <img src="<?=G5_APP_CDN_IMG?>/img_loading_on.gif" class="loading"></a>                            
                            <?php
							} else { 
							?>
                            <a href="#" class="btn_reward_disable"><img src="<?=G5_APP_CDN_IMG?>/nft_c2.png" class=""> EDU rewards X2</a>
                            <?php
							}
							?>
                            </li>
                            <!-- 활성화  btn_mistery, 비활성화 btn_mistery_disable, 활성화일때는 이미지태그에 swing_mistery클래스 추가-->
							<li>
                            <?php
							
							if ($member["nft_c1"] > 0 or $member["nft_c3"] > 0) {
								$sql= "SELECT nft_id from coquiz_g5_nft WHERE mb_id = '{$member["mb_id"]}' AND (nft_type = 'c1' OR nft_type = 'c3') ORDER BY nft_id DESC LIMIT 1";
								$row_nft_id_chk = sql_fetch($sql);
								//echo $row_nft_id_chk["nft_id"];
							?>
                            <a href="#" class="btn_mistery" id="get_mystery_box" onClick="get_mystery_box();"><img src="<?=G5_APP_CDN_IMG?>/giftbox_6.png" class="swing_mistery"> Daily Mystery Box</a>                            
                            <?php
							} else { 
							?>
                            <a href="#" class="btn_mistery_disable" id="get_mystery_box" onClick="#"><img src="<?=G5_APP_CDN_IMG?>/giftbox_6.png" class=""> Daily Mystery Box</a>
                            <?php
							}
							?>                            
                            </li>
						</ul>
			</div>

			<!-- <div class="wallet_close"><a href="<?=G5_APP_LOBBY?>"><img src="<?=G5_APP_CDN_IMG?>/btn_home2.png"></a></div>닫기 -->

		</div>

		<?php include_once(G5_APP_PATH.'/include/footer.php'); // 하단 네비 ?>
	</div>
	<!-- 설정 컨텐츠 끝 -->
<script>	
function full_frame_view(value) {
	document.getElementById("iframe_new_pop").src = value;
	document.getElementById("iframe_new_pop").style.display = "block";
}

function full_frame_close() {
	//window.alert("full_frame_close");
	document.getElementById("iframe_new_pop").src = "<?=G5_APP_URL?>/none.html";
	document.getElementById("iframe_new_pop").style.display = "none";
}

function get_mystery_box() {
	document.getElementById("get_mystery_box").setAttribute('onClick', '#');
	document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=get_mystery_box&nft_id_chk=<?=$row_nft_id_chk["nft_id"]?>";	
}
</script>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html"  width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
<?php
include_once('./_tail.sub.php');
?>