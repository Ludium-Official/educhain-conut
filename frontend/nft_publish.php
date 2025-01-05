<?php
include_once('./_common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동
$g5['title'] = 'NFT 발행 신청';
include_once('./_head.sub.php');

//새로운 시즌 시작
if (COQUIZ_SEASON_OFF == "Y") {echo "<script>window.alert('".COQUIZ_SEASON_OFF_MSG."');location.href='".G5_APP_LOBBY."';</script>";}
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php');;// 상단 hd ?>
<div id="wrapper">
	<div id="container_nftPublish">
    
		<!-- 상단 nft -->
		<div class="nftPublish_top">

			<div class="nftP_pf"><img src="member_conut/360/<?=$member["mb_id"]?>.png?ver=<?=time()?>"></div><!-- nft -->
			<div class="nftP_pf"><img src="<?=G5_APP_CDN_IMG?>/nft_normal/nft_outline_c3.png" id="conut_nft_outline"></div><!-- 테두리 -->

			<div class="nftP_left_c1_on" id="conut_nft_c1_util"><!-- 좌측 미스테리박스/비활성화는  nftP_left_c1 -->
				<span class="nftP_Btxt">Daily</span><br/>
				<img src="<?=G5_APP_CDN_IMG?>/nft_c1.png?ver=240206"><br/><span>Mystery Box</span>
			</div>

			<div class="nftP_right_c2_on" id="conut_nft_c2_util"><!-- 우측 랭킹파이 보상/비활성화는  nftP_right_c2 -->
				<span class="nftP_Btxt">X2</span><br/>
				<img src="<?=G5_APP_CDN_IMG?>/nft_c2.png"><br/><span>Ranking rewards</span>
			</div>

		</div>

		<div class="nftPublish_center">
			<div class="hei_100pro wid_90pro">
				
				<div class="nftP_cBox c1N" id="conut_nft_c1" onClick="change_conut_nft('c1');">
					<ul>
						<li><span class="c1N_txt">NFT<br/><span  class="ft_26_bold">C1</span><br/><span class="c1N_ck"><img src="<?=G5_APP_CDN_IMG?>/attend_cookie.png">990</span></span></li>
						<li><span><img src="<?=G5_APP_CDN_IMG?>/giftbox_6.png?ver=240206" class="c1N_1"></span></li>
						<li><div><span class="c1N_3">Daily Mystery Box</span><br/><span class="c1N_4">+ Random rewards</span><!--<br/><span class="c1_3">+ 코넛 굿즈 문구</span> <a href="#" onClick="full_frame_view('<?=G5_APP_URL?>/item_get.php?item_get_type=goods_c1&item_get_ea=none&publish_area=publish_area');"><img src="/0_v1_img/btn_view2.png"></a>--></div></li>
					</ul>
				</div>

				<div class="nftP_cBox c2N" id="conut_nft_c2" onClick="change_conut_nft('c2');">
					<ul>
						<li><span class="c2N_txt">NFT<br/><span  class="ft_26_bold">C2</span><br/><span class="c1N_ck"><img src="<?=G5_APP_CDN_IMG?>/attend_cookie.png">1,990</span></span></li>
						<li><span><img src="<?=G5_APP_CDN_IMG?>/nft_c2.png" class="c2N_1"></li>
						<li><div><span class="c2N_3">Ranking EDU</span><span class="c2N_3"> rewards X2</span><br/><span class="c2N_4">Seasonal prizes and event rewards doubled.</span><!--<br/><span class="c2_5">+ 코넛 굿즈 베이직</span> <a href="#" onClick="full_frame_view('<?=G5_APP_URL?>/item_get.php?item_get_type=goods_c2&item_get_ea=none&publish_area=publish_area');"><img src="/0_v1_img/btn_view2.png"></a>--></div></li>
					</ul>
				</div>

				<div class="nftP_cBox c3N c_on" id="conut_nft_c3" onClick="change_conut_nft('c3');"><!-- 활성화 클래스 c_on -->
					<ul>
						<li><span class="c3N_txt">NFT<br/><span  class="ft_26_bold">C3</span><br/><span class="c1N_ck"><img src="<?=G5_APP_CDN_IMG?>/attend_cookie.png">2,490</span></span></li>
						<li><span><img src="<?=G5_APP_CDN_IMG?>/nft_c3_2.png?ver=240206" class="c3N_1"></li>
						<li><div><span class="c3N_3">C1 & </span><span class="c3N_4"> C2</span><br/><span class="c3N_5">Daily Mystery Box, Ranking EDU X2</span><!--<br/><span class="c3_6">+ 코넛 굿즈 스페셜</span> <a href="#" onClick="full_frame_view('<?=G5_APP_URL?>/item_get.php?item_get_type=goods_c3&item_get_ea=none&publish_area=publish_area');"><img src="/0_v1_img/btn_view2.png"></a>--></div></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="nftPublish_bottom">
			<ul>
				<li><input type="hidden" id="nft_type_v" value="c3"><input type="checkbox" id="nft_publ_check"> Agree to the Terms of Service and Privacy Policy <a href="#" target="_blank">[Full Text]</a></li>
				<li>
                <a href="<?=G5_APP_URL?>/nft.php?nft_cat_now=ALL" class="grayBack">Back</a> 
                <a href="#" class="orangeBack" onClick="nft_publish_check();">Mint</a>
                </li>
			</ul>
		</div>
		
	
	</div>
</div>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="100%" height="300" border="0" id="app_action_frame"></iframe>
<script>	
function change_conut_nft(ccn_value) {

	switch (ccn_value) {
	  case "c1":
	  	conut_nft_outline
		document.getElementById("conut_nft_outline").src = "<?=G5_APP_CDN_IMG?>/nft_normal/nft_outline_c1.png";
	  
		document.getElementById("conut_nft_c1").className = "nftP_cBox c1N c_on";
		document.getElementById("conut_nft_c2").className = "nftP_cBox c2N";
		document.getElementById("conut_nft_c3").className = "nftP_cBox c3N";
		
		document.getElementById("conut_nft_c1_util").className = "nftP_left_c1_on";
		document.getElementById("conut_nft_c2_util").className = "nftP_right_c2";
		
		document.getElementById("nft_type_v").value = "c1";
	  break;	
	  
	  case "c2":
	  	document.getElementById("conut_nft_outline").src = "<?=G5_APP_CDN_IMG?>/nft_normal/nft_outline_c2.png";
	  
		document.getElementById("conut_nft_c1").className = "nftP_cBox c1N";
		document.getElementById("conut_nft_c2").className = "nftP_cBox c2N c_on";
		document.getElementById("conut_nft_c3").className = "nftP_cBox c3N";
		
		document.getElementById("conut_nft_c1_util").className = "nftP_left_c1";
		document.getElementById("conut_nft_c2_util").className = "nftP_right_c2_on";
		
		document.getElementById("nft_type_v").value = "c2";
	  break;
	  
	  case "c3":
		document.getElementById("conut_nft_outline").src = "<?=G5_APP_CDN_IMG?>/nft_normal/nft_outline_c3.png";	  
	  
		document.getElementById("conut_nft_c1").className = "nftP_cBox c1N";
		document.getElementById("conut_nft_c2").className = "nftP_cBox c2N";
		document.getElementById("conut_nft_c3").className = "nftP_cBox c3N c_on";
		
		document.getElementById("conut_nft_c1_util").className = "nftP_left_c1_on";
		document.getElementById("conut_nft_c2_util").className = "nftP_right_c2_on";
		
		document.getElementById("nft_type_v").value = "c3";
	  break;
	}	
	
}

function nft_publish_check() {
	
	if (document.getElementById("nft_publ_check").checked) {
	} else {
		swal_alert('','Please agree to the Terms of Service and Privacy Policy.');
		return;
	}
	
	document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=my_nft_submit&nft_publ_type="+document.getElementById("nft_type_v").value;
	
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