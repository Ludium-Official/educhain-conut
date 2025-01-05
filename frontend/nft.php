<?php
include_once('common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동
$g5['title'] = 'NFT';
include_once('head.sub.php');

//새로운 시즌 시작
if (COQUIZ_SEASON_OFF == "Y") {echo "<script>window.alert('".COQUIZ_SEASON_OFF_MSG."');location.href='".G5_APP_LOBBY."';</script>";}
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php');// 상단 hd ?>
<div id="wrapper">
	<div id="container_nft"><!-- 이미지는 두가지로, 큰사진은 700 X 700 / 작은사진은 100 X 100 -->
    
		<!-- 상단 흰색배경 -->
		<div class="nftWrap">
			<div class="nftBox_position">
				<!-- 조립배경 박스 -->
				<ul class="nftBox">
                	<?php
					if ($member["1_BODY"] == "") {
						$BODY_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_body.png";
						$BODY_profil_src = G5_APP_CDN_IMG."/nft_normal/1_BODY/700/55_Normal_Yellow.png";											
					} else {
						$BODY_parts_src = G5_APP_CDN_IMG."/nft_normal/1_BODY/100/".$member["1_BODY"].".png";
						$BODY_profil_src = G5_APP_CDN_IMG."/nft_normal/1_BODY/700/".$member["1_BODY"].".png";
					}
					
					if ($member["2_BOTTOM"] == "") {
						$BOTTOM_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_bottom.png";
						$BOTTOM_profil_src = G5_APP_CDN_IMG."/nft_normal/2_BOTTOM/700/7_BROWN.png";										
					} else {
						$BOTTOM_parts_src = G5_APP_CDN_IMG."/nft_normal/2_BOTTOM/100/".$member["2_BOTTOM"].".png";
						$BOTTOM_profil_src = G5_APP_CDN_IMG."/nft_normal/2_BOTTOM/700/".$member["2_BOTTOM"].".png";						
					}
					
					if ($member["3_BACKGROUND"] == "") {
						$BACKGROUND_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_back_n.png";
						$BACKGROUND_profil_src = G5_APP_CDN_IMG."/nft_normal/none_select.png";											
					} else {
						$BACKGROUND_parts_src = G5_APP_CDN_IMG."/nft_normal/3_BACKGROUND/100/".$member["3_BACKGROUND"].".png";
						$BACKGROUND_profil_src = G5_APP_CDN_IMG."/nft_normal/3_BACKGROUND/700/".$member["3_BACKGROUND"].".png";
					}
					
					if ($member["4_HAIR"] == "") {
						$HAIR_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_hair.png";
						$HAIR_profil_src = G5_APP_CDN_IMG."/nft_normal/none_select.png";											
					} else {
						$HAIR_parts_src = G5_APP_CDN_IMG."/nft_normal/4_HAIR/100/".$member["4_HAIR"].".png";
						$HAIR_profil_src = G5_APP_CDN_IMG."/nft_normal/4_HAIR/700/".$member["4_HAIR"].".png";
					}
					
					if ($member["5_HAIR_POINT"] == "") {
						$HAIR_POINT_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_hair_point_n.png";
						$HAIR_POINT_profil_src = G5_APP_CDN_IMG."/nft_normal/5_HAIR_POINT/700/8_BROWN.png";											
					} else {
						$HAIR_POINT_parts_src = G5_APP_CDN_IMG."/nft_normal/5_HAIR_POINT/100/".$member["5_HAIR_POINT"].".png";
						$HAIR_POINT_profil_src = G5_APP_CDN_IMG."/nft_normal/5_HAIR_POINT/700/".$member["5_HAIR_POINT"].".png";
					}
					
					if ($member["6_ACCESSORY"] == "") {
						$ACCESSORY_parts_src = G5_APP_CDN_IMG."/nft_normal/cate_accessory.png";
						$ACCESSORY_profil_src = G5_APP_CDN_IMG."/nft_normal/none_select.png";										
					} else {
						$ACCESSORY_parts_src = G5_APP_CDN_IMG."/nft_normal/6_ACCESSORY/100/".$member["6_ACCESSORY"].".png";
						$ACCESSORY_profil_src = G5_APP_CDN_IMG."/nft_normal/6_ACCESSORY/700/".$member["6_ACCESSORY"].".png";
					}
					?>
					<li><img src="<?=$BACKGROUND_parts_src?>" id="3_BACKGROUND_parts"><input type="hidden" id="my_3_BACKGROUND" value="<?=$member["3_BACKGROUND"]?>"><input type="hidden" id="my_3_BACKGROUND_id" value=""></li>
					<li></li>
					<li><img src="<?=$BOTTOM_parts_src?>" id="2_BOTTOM_parts"><input type="hidden" id="my_2_BOTTOM" value="<?=$member["2_BOTTOM"]?>"><input type="hidden" id="my_2_BOTTOM_id" value=""></li>
					<li><img src="<?=$BODY_parts_src?>" id="1_BODY_parts"><input type="hidden" id="my_1_BODY" value="<?=$member["1_BODY"]?>"><input type="hidden" id="my_1_BODY_id" value=""></li>
					<li></li>
					<li><img src="<?=$HAIR_parts_src?>" id="4_HAIR_parts"><input type="hidden" id="my_4_HAIR" value="<?=$member["4_HAIR"]?>"><input type="hidden" id="my_4_HAIR_id" value=""></li>
					<li><img src="<?=$HAIR_POINT_parts_src?>" id="5_HAIR_POINT_parts"><input type="hidden" id="my_5_HAIR_POINT" value="<?=$member["5_HAIR_POINT"]?>"><input type="hidden" id="my_5_HAIR_POINT_id" value=""></li>
					<li></li>
					<li><img src="<?=$ACCESSORY_parts_src?>" id="6_ACCESSORY_parts"><input type="hidden" id="my_6_ACCESSORY" value="<?=$member["6_ACCESSORY"]?>"><input type="hidden" id="my_6_ACCESSORY_id" value=""></li>
					
					<!-- NFT 완성하기 -->
					<div class="nftPf">
						<div id="3_BACKGROUND_img_div"><img src="<?=$BACKGROUND_profil_src?>" id="3_BACKGROUND_img" style="opacity:0;" class="nftBack_fadeIn"></div>
						<div id="1_BODY_img_div"><img src="<?=$BODY_profil_src?>" id="1_BODY_img" style="opacity:0;" class="nftBody_bounceIn"></div>
						<div id="5_HAIR_POINT_img_div"><img src="<?=$HAIR_POINT_profil_src?>" id="5_HAIR_POINT_img" style="opacity:0;" class="nft_fadeInUp1"></div>
						<div id="2_BOTTOM_img_div"><img src="<?=$BOTTOM_profil_src?>" id="2_BOTTOM_img" style="opacity:0;" class="nft_fadeInUp2"></div>
						<div id="4_HAIR_img_div"><img src="<?=$HAIR_profil_src?>" id="4_HAIR_img" style="opacity:0;" class="nft_fadeInUp3"></div>
						<div id="6_ACCESSORY_img_div"><img src="<?=$ACCESSORY_profil_src?>" id="6_ACCESSORY_img" style="opacity:0;" class="nft_fadeInUp4"></div>
						<div>
                        <?php 
						if ($member["nft_c3"] > 0) { $out_line_dis = "<img src='".G5_APP_CDN_IMG."/nft_normal/nft_outline_c3.png' class='nftOutline_bounceIn' style='opacity:0;'>";}
						else if ($member["nft_c2"] > 0) { $out_line_dis = "<img src='".G5_APP_CDN_IMG."/nft_normal/nft_outline_c2.png' class='nftOutline_bounceIn' style='opacity:0;'>";}
						else if ($member["nft_c1"] > 0) { $out_line_dis = "<img src='".G5_APP_CDN_IMG."/nft_normal/nft_outline_c1.png' class='nftOutline_bounceIn' style='opacity:0;'>";}
						?>
                        <?=$out_line_dis?>
                        </div>
						<!--<img src="<?=G5_APP_CDN_IMG?>/nft_normal/icon_check.png" class="nftCheck"> 체크되면 icon_check_on.png -->
					</div>
				</ul>
                
				<!-- 홈,처음,저장,발행 버튼 -->
				<div class="nftMake"><!-- 처음,저장,발행 버튼은 활성화일때 파일명 뒤에 _on이 붙음 -->
                	<img id="go_lobby_btn" src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_gohome.png">
					<img id="parts_deafult_btn" src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_start_on.png">
					<img id="parts_save_btn" src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_save_on.png">
                    <?php
                    $sql_nft_go_yn = "SELECT count(parts_id) AS cnt from coquiz_g5_parts WHERE mb_id = '".$member["mb_id"]."' AND parts_use_profil = '1' AND parts_use_nft = '0'";
                    $row_nft_go_yn = sql_fetch($sql_nft_go_yn);
                    if ($row_nft_go_yn["cnt"] == 6) {
					?>
					<img id="go_nft_btn" src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_publish_yellow.png" class="scale_updown">
                    <?php } else { ?>
                    <img id="go_nft_btn" src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_publish_on.png" ><!-- 디폴트일땐 btn_publish_on.png / 클래스 없음 -->
                    <?php } ?>
					<!-- 예전 버튼 <img src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_nft_default.png">활성화는  btn_nft_end.png -->
                </div>

			</div>
		</div>
		
		<div class="nftgrayWrap">
			<div class="nftCategory_position">
				<!-- NFT 카테고리 -->
				<ul class="nftCategory"><!-- 활성화되면 span 클래스에 on을 쓰고, 이미지명에 _on 이 붙는다-->
					<!--<li><span class="on"><img src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_on.png"></span></li>-->
                    <li id="nft_cate_0"><span id="nftCat_span_0" <?php if (!$_GET["nft_cat_now"] or $_GET["nft_cat_now"] == "ALL") {echo "class='on'";}?>><img id="nftCat_img_0" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n<?php if (!$_GET["nft_cat_now"] or $_GET["nft_cat_now"] == "ALL") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_1"><span id="nftCat_span_1" <?php if ($_GET["nft_cat_now"] == "3_BACKGROUND") {echo "class='on'";}?>><img id="nftCat_img_1" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n<?php if ($_GET["nft_cat_now"] == "3_BACKGROUND") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_2"><span id="nftCat_span_2" <?php if ($_GET["nft_cat_now"] == "1_BODY") {echo "class='on'";}?>><img id="nftCat_img_2" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_body<?php if ($_GET["nft_cat_now"] == "1_BODY") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_3"><span id="nftCat_span_3" <?php if ($_GET["nft_cat_now"] == "5_HAIR_POINT") {echo "class='on'";}?>><img id="nftCat_img_3" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n<?php if ($_GET["nft_cat_now"] == "5_HAIR_POINT") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_4"><span id="nftCat_span_4" <?php if ($_GET["nft_cat_now"] == "2_BOTTOM") {echo "class='on'";}?>><img id="nftCat_img_4" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom<?php if ($_GET["nft_cat_now"] == "2_BOTTOM") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_5"><span id="nftCat_span_5" <?php if ($_GET["nft_cat_now"] == "4_HAIR") {echo "class='on'";}?>><img id="nftCat_img_5" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair<?php if ($_GET["nft_cat_now"] == "4_HAIR") {echo "_on";}?>.png"></span></li>
					<li id="nft_cate_6"><span id="nftCat_span_6" <?php if ($_GET["nft_cat_now"] == "6_ACCESSORY") {echo "class='on'";}?>><img id="nftCat_img_6" src="<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory<?php if ($_GET["nft_cat_now"] == "6_ACCESSORY") {echo "_on";}?>.png"></span></li>
					<input type="hidden" id="nft_cat_now" value="<?php if($_GET["nft_cat_now"]) {echo $_GET["nft_cat_now"];} else {echo "ALL";}?>">
                </ul>

				<div class="nftList">
                	<!--<span class="on">-->
					<ul id="my_parts_list">

					</ul>
				</div>

				<!-- 기존 홈 버튼 삭제
					<div class="nftMake">
						<a href="<?=G5_APP_LOBBY?>"><img src="<?=G5_APP_CDN_IMG?>/nft_normal/btn_home.png"></a>
					</div>
				-->
			</div>
		</div>

	
	</div>
</div>
<script>
function my_profil_save() {
	
	var nft_cat_now = document.getElementById("nft_cat_now").value;
	var my_1_BODY = document.getElementById("my_1_BODY").value;
	var my_2_BOTTOM = document.getElementById("my_2_BOTTOM").value;
	var my_3_BACKGROUND = document.getElementById("my_3_BACKGROUND").value;
	var my_4_HAIR = document.getElementById("my_4_HAIR").value;
	var my_5_HAIR_POINT = document.getElementById("my_5_HAIR_POINT").value;
	var my_6_ACCESSORY = document.getElementById("my_6_ACCESSORY").value;
	
	var my_1_BODY_id = document.getElementById("my_1_BODY_id").value;
	var my_2_BOTTOM_id = document.getElementById("my_2_BOTTOM_id").value;
	var my_3_BACKGROUND_id = document.getElementById("my_3_BACKGROUND_id").value;
	var my_4_HAIR_id = document.getElementById("my_4_HAIR_id").value;
	var my_5_HAIR_POINT_id = document.getElementById("my_5_HAIR_POINT_id").value;
	var my_6_ACCESSORY_id = document.getElementById("my_6_ACCESSORY_id").value;
	
	document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=my_profil_save&nft_cat_now="+ nft_cat_now +"&my_1_BODY=" + my_1_BODY + "&my_2_BOTTOM=" + my_2_BOTTOM + "&my_3_BACKGROUND=" + my_3_BACKGROUND + "&my_4_HAIR=" + my_4_HAIR + "&my_5_HAIR_POINT=" + my_5_HAIR_POINT + "&my_6_ACCESSORY=" + my_6_ACCESSORY + "&my_1_BODY_id=" + my_1_BODY_id + "&my_2_BOTTOM_id=" + my_2_BOTTOM_id + "&my_3_BACKGROUND_id=" + my_3_BACKGROUND_id + "&my_4_HAIR_id=" + my_4_HAIR_id + "&my_5_HAIR_POINT_id=" + my_5_HAIR_POINT_id + "&my_6_ACCESSORY_id=" + my_6_ACCESSORY_id;	
}

function nft_parts_change(folder_src, file_src, parts_id) {
	var now_my_parts = folder_src + "_parts";
	var now_profil_parts = folder_src + "_img";
	var now_profil_parts_value = "my_" + folder_src;
	var now_profil_parts_id_value = "my_" + folder_src + "_id";
	
	//document.getElementById("parts_deafult").src = "<?=G5_APP_CDN_IMG?>/nft_normal/btn_start_on.png";
	//document.getElementById("parts_save").src = "<?=G5_APP_CDN_IMG?>/nft_normal/btn_save_on.png";
	
	//window.alert(now_profil_parts_id_value);
	//var now_parts_id_value = "my_parts" + parts_id_value;
	document.getElementById(now_my_parts).src = "<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/100/" + file_src + ".png";
	//document.getElementById(now_profil_parts).src = "<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png"; 단순 경로 변경
	
	switch (folder_src) {

		case "3_BACKGROUND":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("3_BACKGROUND_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='3_BACKGROUND_img' style='opacity:0;' class='nftBack_fadeIn'>";	
		break;
		
		case "1_BODY":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("1_BODY_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='1_BODY_img' style='opacity:0;' class='nftBody_change'>";	
		break;
		
		case "5_HAIR_POINT":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("5_HAIR_POINT_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='5_HAIR_POINT_img' style='opacity:0;' class='nft_change'>";	
		break;
		
		case "2_BOTTOM":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("2_BOTTOM_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='2_BOTTOM_img' style='opacity:0;' class='nft_change'>";	
		break;
		
		case "4_HAIR":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("4_HAIR_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='4_HAIR_img' style='opacity:0;' class='nft_change'>";	
		break;
		
		case "6_ACCESSORY":
			//document.getElementById(now_profil_parts).className = "nftBack_fadeIn";		
			document.getElementById("6_ACCESSORY_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='6_ACCESSORY_img' style='opacity:0;' class='nft_change'>";	
		break;
		
		default:
		
	}
	
	document.getElementById(now_profil_parts_value).value = file_src;
	document.getElementById(now_profil_parts_id_value).value = parts_id;
	//window.alert(file_src);
	//window.alert(parts_id);
	//document.getElementById(now_parts_id_value).className = "on";

}

function nftCat_change(parts_section) {
	switch (parts_section) {
	  case "ALL":
		document.getElementById("nftCat_span_0").className = "on";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n_on.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";	
	  break;
	  
	  case "3_BACKGROUND":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "on";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n_on.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";		
	  break;
	  
	  case "1_BODY":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "on";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body_on.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";
	  break;
	  
	  case "4_HAIR":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "on";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_on.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";
	  break;
	  
	  case "2_BOTTOM":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "on";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom_on.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";
	  break;
	  
	  case "5_HAIR_POINT":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "on";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n_on.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory.png";
	  break;
	  
	  case "6_ACCESSORY":
		document.getElementById("nftCat_span_0").className = "";
		document.getElementById("nftCat_span_1").className = "";
		document.getElementById("nftCat_span_2").className = "";
		document.getElementById("nftCat_span_3").className = "";
		document.getElementById("nftCat_span_4").className = "";
		document.getElementById("nftCat_span_5").className = "";
		document.getElementById("nftCat_span_6").className = "on";
		
		document.getElementById("nftCat_img_0").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_all_n.png";
		document.getElementById("nftCat_img_1").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_back_n.png";
		document.getElementById("nftCat_img_2").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_body.png";
		document.getElementById("nftCat_img_3").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair_point_n.png";
		document.getElementById("nftCat_img_4").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_bottom.png";
		document.getElementById("nftCat_img_5").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_hair.png";
		document.getElementById("nftCat_img_6").src = "<?=G5_APP_CDN_IMG?>/nft_normal/cate_accessory_on.png";
	  break;

	  default:

	}
	document.getElementById("nft_cat_now").value = parts_section;
	document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=my_inven_change&parts_section=" + parts_section;	
}

function nft_parts_buy(parts_section_v, parts_detail_v, cookie_ea_v) {
	//window.alert(parts_section_v);
	//window.alert(parts_detail_v);
	var buy_parts_frame_link = "<?=G5_APP_URL?>/app_event.php?type_v=nft_parts_buy&parts_section=" + parts_section_v + "&parts_detail=" + parts_detail_v + "&cookie_ea=" + cookie_ea_v;
	var buy_parts_frame_title = "<img src ='<?=G5_APP_CDN_IMG?>/nft_normal/" + parts_section_v + "/100/" + parts_detail_v + ".png' style='width:100px;margin-right:10px;'>";
	var buy_parts_frame_text = "<img src ='<?=G5_APP_CDN_IMG?>/attend_cookie.png' style='width:45px;margin-right:5px;'> " + cookie_ea_v + " for exchange?";
	swal_alert(buy_parts_frame_title, buy_parts_frame_text, 'y', buy_parts_frame_link, 'frame');
	
	//document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=nft_parts_buy&parts_section=" + parts_section_v + "&parts_detail=" + parts_detail_v + "&cookie_ea=" + cookie_ea_v;	
}

function my_nft_submit() {
	/*
	var nft_cat_now = document.getElementById("nft_cat_now").value;
	var my_1_BODY = document.getElementById("my_1_BODY").value;
	var my_2_BOTTOM = document.getElementById("my_2_BOTTOM").value;
	var my_3_BACKGROUND = document.getElementById("my_3_BACKGROUND").value;
	var my_4_HAIR = document.getElementById("my_4_HAIR").value;
	var my_5_HAIR_POINT = document.getElementById("my_5_HAIR_POINT").value;
	var my_6_ACCESSORY = document.getElementById("my_6_ACCESSORY").value;
	
	var my_1_BODY_id = document.getElementById("my_1_BODY_id").value;
	var my_2_BOTTOM_id = document.getElementById("my_2_BOTTOM_id").value;
	var my_3_BACKGROUND_id = document.getElementById("my_3_BACKGROUND_id").value;
	var my_4_HAIR_id = document.getElementById("my_4_HAIR_id").value;
	var my_5_HAIR_POINT_id = document.getElementById("my_5_HAIR_POINT_id").value;
	var my_6_ACCESSORY_id = document.getElementById("my_6_ACCESSORY_id").value;


document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=my_nft_submit&my_1_BODY=" + my_1_BODY + "&my_2_BOTTOM=" + my_2_BOTTOM + "&my_3_BACKGROUND=" + my_3_BACKGROUND + "&my_4_HAIR=" + my_4_HAIR + "&my_5_HAIR_POINT=" + my_5_HAIR_POINT + "&my_6_ACCESSORY=" + my_6_ACCESSORY + "&my_1_BODY_id=" + my_1_BODY_id + "&my_2_BOTTOM_id=" + my_2_BOTTOM_id + "&my_3_BACKGROUND_id=" + my_3_BACKGROUND_id + "&my_4_HAIR_id=" + my_4_HAIR_id + "&my_5_HAIR_POINT_id=" + my_5_HAIR_POINT_id + "&my_6_ACCESSORY_id=" + my_6_ACCESSORY_id;
*/
document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=my_nft_submit_prev";	

}


function full_frame_view_pop(value) {
	document.getElementById("iframe_new_pop_pop").src = value;
	document.getElementById("iframe_new_pop_pop").style.display = "block";
}

function full_frame_close_pop() {
	document.getElementById("iframe_new_pop_pop").src = "<?=G5_APP_URL?>/none.html";
	document.getElementById("iframe_new_pop_pop").style.display = "none";
}


function delete_parts() {
	swal_alert('Coming Soon :)');	
}

window.onload = function(){
	
	<?php if ($_GET["nft_cat_now"] == "3_BACKGROUND") { ?>
	nftCat_change('3_BACKGROUND');
	<?php } else if ($_GET["mb_first_nft"] == "ok" or $_GET["nft_cat_now"] == "ALL") { ?>
	nftCat_change('ALL');
	<? }?>
}
</script>

<script>
// 로비
const go_lobby_btn = document.getElementById('go_lobby_btn');
	go_lobby_btn.addEventListener('touchstart', (event) => {
	go_lobby_btn.className = "smaller";   // qz_exit_ready 클래스 유지
});
go_lobby_btn.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_0_0'});//소리
	go_lobby_btn.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("location.href='<?=G5_APP_URL?>/lobby.php';", 50); //0.05초후 이동
});

// 처음
const parts_deafult_btn = document.getElementById('parts_deafult_btn');
	parts_deafult_btn.addEventListener('touchstart', (event) => {
	parts_deafult_btn.className = "smaller";   // qz_exit_ready 클래스 유지
});
parts_deafult_btn.addEventListener('touchend', (event) => { 
	//postMessageToApp('soundStart', {file: 'sound_0_0'});//소리 
	parts_deafult_btn.className = "bigger"; // qz_exit_ready 클래스 유지	
	setTimeout("location.href='<?=G5_APP_URL?>/nft.php?mb_first_nft=ok';", 50); //0.05초후 이동
});

// 저장
const parts_save_btn = document.getElementById('parts_save_btn');
	parts_save_btn.addEventListener('touchstart', (event) => {
	parts_save_btn.className = "smaller";   // qz_exit_ready 클래스 유지
});
	parts_save_btn.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_4_5'});//소리
	parts_save_btn.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout(my_profil_save(), 50); //0.05초후 이동
});


// 발행

const go_nft_btn = document.getElementById('go_nft_btn');
	go_nft_btn.addEventListener('touchstart', (event) => {
	go_nft_btn.className = "smaller";   // qz_exit_ready 클래스 유지
});
	go_nft_btn.addEventListener('touchend', (event) => {
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리	
	go_nft_btn.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("my_nft_submit()", 50); //0.05초후 이동
});


// 카테고리 전체
const nft_cate_0 = document.getElementById('nft_cate_0');
nft_cate_0.addEventListener('touchstart', (event) => {
	nft_cate_0.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_0.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리	
	nft_cate_0.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('ALL')", 50); //0.05초후 이동
});

// 카테고리 배경
const nft_cate_1 = document.getElementById('nft_cate_1');
nft_cate_1.addEventListener('touchstart', (event) => {
	nft_cate_1.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_1.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리
	nft_cate_1.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('3_BACKGROUND')", 50); //0.05초후 이동
});

// 카테고리 BODY
const nft_cate_2 = document.getElementById('nft_cate_2');
nft_cate_2.addEventListener('touchstart', (event) => {
	nft_cate_2.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_2.addEventListener('touchend', (event) => { 
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리 
	nft_cate_2.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('1_BODY')", 50); //0.05초후 이동
});

// 카테고리 HAIR
const nft_cate_3 = document.getElementById('nft_cate_3');
nft_cate_3.addEventListener('touchstart', (event) => {
	nft_cate_3.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_3.addEventListener('touchend', (event) => {
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리
	nft_cate_3.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('5_HAIR_POINT')", 50); //0.05초후 이동
});

// 카테고리 BOTTOM
const nft_cate_4 = document.getElementById('nft_cate_4');
nft_cate_4.addEventListener('touchstart', (event) => {
	nft_cate_4.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_4.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리
	nft_cate_4.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('2_BOTTOM')", 50); //0.05초후 이동
});

// 카테고리 HAIR POINT
const nft_cate_5 = document.getElementById('nft_cate_5');
nft_cate_5.addEventListener('touchstart', (event) => {
	nft_cate_5.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_5.addEventListener('touchend', (event) => {
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리
	nft_cate_5.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('4_HAIR')", 50); //0.05초후 이동
});

// 카테고리 ACCESSORY
const nft_cate_6 = document.getElementById('nft_cate_6');
nft_cate_6.addEventListener('touchstart', (event) => {
	nft_cate_6.className = "smaller";   // qz_exit_ready 클래스 유지
});
nft_cate_6.addEventListener('touchend', (event) => {  
	//postMessageToApp('soundStart', {file: 'sound_rank_move'});//소리
	nft_cate_6.className = "bigger"; // qz_exit_ready 클래스 유지
	setTimeout("nftCat_change('6_ACCESSORY')", 50); //0.05초후 이동
});
</script>

<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>

<?php
include_once('tail.sub.php');
?>