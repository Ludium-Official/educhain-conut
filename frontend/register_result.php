<?php
include_once('common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //비회원시 메인 페이지 이동
$g5['title'] = '회원가입 완료';
include_once('head.sub.php');
add_stylesheet('<link rel="stylesheet" href="css/register_style.css">', 0);

//회원 기본 재화 지급
$ins_key_newbie = insert_key(0, $member["mb_id"], 100, "COQUIZ Welcome Key", $member["mb_id"], "newbie", "join");
$ins_x2_newbie = insert_item(0, $member["mb_id"], "x2", 300, "COQUIZ Welcome Item", $member["mb_id"], "newbie", "join");
$ins_time_newbie = insert_item(0, $member["mb_id"], "time", 300, "COQUIZ Welcome Item", $member["mb_id"], "newbie", "join");
$ins_pass_newbie = insert_item(0, $member["mb_id"], "pass", 300, "COQUIZ Welcome Item", $member["mb_id"], "newbie", "join");
$ins_cookie_newbie = insert_cookie(0, $member["mb_id"], 10000, "COQUIZ Welcome Cookie", $member["mb_id"], "newbie", "join");
$ins_candy_newbie = insert_candy(0, $member["mb_id"], 5000, "COQUIZ Welcome Candy", $member["mb_id"], "newbie", "join");	
$ins_roulette_newbie = insert_roulette(0, $member["mb_id"], 100, "COQUIZ Welcome Item", $member["mb_id"], "newbie", "join");	
$ins_pie_newbie = insert_pie(0, $member["mb_id"], 10000, "COQUIZ Welcome Pie", $member["mb_id"], "newbie", "join");
?>
<div id="wrapper">
<div id="container">

	<div class="intro_wrap">
	
		<!-- 1 인트로 -->
		<div class="intro1" id="wc_s_1">
			<div class="intro_right"><a href="#" onClick="document.getElementById('wc_s_1').className = 'intro1 Out_to_Left';document.getElementById('wc_s_2').style.display = 'block';document.getElementById('wc_s_2').className = 'intro2 In_to_Left';"><img src="<?=G5_APP_CDN_IMG?>/intro_right.png" class="smallBig2"></a></div>

			<ul class="intro1_txt">
				<li>Hi! Nice to meet you.</li>
				<li><?=$member['mb_nick']?></li>
				<li>I’m Conut.</li>
				<li>Please think of me as a friend<br/>who solves quizzes together.</li>
			</ul>

			<div class="intro1_img">
				<div><img src="<?=G5_APP_CDN_IMG?>/intro1_1.png"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro1_2.png"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro1_3.png"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro1.png" class="swing_intro1"></div>
			</div>
		
		</div>
	<!--인트로 -->

	<!-- 2 인트로 -->
		<div class="intro2" style="display:none;" id="wc_s_2">
			<div class="intro_left"><!--<a href=""><img src="<?=G5_APP_CDN_IMG?>/intro_left.png"></a>--></div>
			<div class="intro_right"><a href="#" onClick="document.getElementById('wc_s_2').className = 'intro2 Out_to_Left';document.getElementById('wc_s_3').style.display = 'block';document.getElementById('wc_s_3').className = 'intro3 In_to_Left';"><img src="<?=G5_APP_CDN_IMG?>/intro_right.png" class="smallBig2"></a></div>

			<ul class="intro2_txt">
				<li>I used to share updates<br/>on the blockchain world</li>
				<li>through a newsletter,</li>
				<li>but I wanted to have more fun,</li>
				<li>so I decided to start [COQUIZ].</li>
			</ul>

			<div class="intro2_img">
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_5.png" class="fadeInDown_news5" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_6.png" class="fadeInDown_news6" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_7.png" class="fadeInDown_news7" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_8.png" class="fadeInDown_news8" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_1.png" class="fadeInDown_news1" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_2.png" class="fadeInDown_news2" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_3.png" class="fadeInDown_news3" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/newsletter_4.png" class="fadeInDown_news4" style="opacity:0;"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro2.png"></div>
			</div>
		</div>
	<!-- 2 인트로 -->

		<!-- 3 인트로/파츠 선물 -->
		<div class="intro3" style="display:none;" id="wc_s_3" >

			<ul class="intro4_txt">
				<li>I’ll give you an accessory part as a gift</li>
				<li>to celebrate our meeting.</li>
			</ul>

			<div class="intro4_img">            
				<div><img src="<?=G5_APP_CDN_IMG?>/nft_normal/parts_default2.png"></div> <!-- 기본 코넛 -->
				<div id="6_ACCESSORY_img_div"><img src="<?=G5_APP_CDN_IMG?>/nft_normal/none_select.png" id="6_ACCESSORY_img" style="opacity:0;" class="nft_fadeInUp4"></div> <!-- 선택한 악세서리 -->
				<div style="display:none;" id="finish_comment">
					<div class="intro_alert_1"><img src="<?=G5_APP_CDN_IMG?>/intro5_alert.png"></div>
					<div class="intro_alert_2"><img src="<?=G5_APP_CDN_IMG?>/intro6_alert.png"></div>
				</div> <!-- 탁월한 선택 풍선말 -->
			</div>            

			<div class="nftList">
					<ul id="my_parts_list">
                        <?php
                        // 전체 파츠							
							$my_parts_dir = "edu_img/nft_normal/6_ACCESSORY/100";
							//echo $my_parts_dir;
							   							
							if (is_dir($my_parts_dir)){     

							  if ($dh = opendir($my_parts_dir)){                     
								while (($parts_file_v = readdir($dh)) !== false){   
									if($parts_file_v != "." and $parts_file_v != "..") { 
									$parts_file_v_exp = explode(".",$parts_file_v);
									$parts_section_inner_html = $parts_section_inner_html . "<li><span><img src='".G5_APP_CDN_IMG."/nft_normal/6_ACCESSORY/100/{$parts_file_v_exp[0]}.png' onClick=nft_parts_change('6_ACCESSORY','{$parts_file_v_exp[0]}','none');></span></li>";                           		  
									}
								}                                           
								closedir($dh);                              
							  } 
							                                              
							}
						echo $parts_section_inner_html;
                        ?>                       
					</ul>
				</div>

				<div class="intro4_btn" id="my_profil_save_btn">
                <input type="hidden" id="my_6_ACCESSORY" value="">
				<a href="#" onClick="my_profil_save();"><img src="<?=G5_APP_CDN_IMG?>/intro4_select_btn.png" class="smallBig3"></a>
				</div>
                		
		</div>
	<!-- 3 인트로/파츠 선물 -->
    
    <!-- 4 인트로 -->
		<div class="intro4" style="display:none;" id="wc_s_4">
			<div class="intro_left"><!--<a href=""><img src="<?=G5_APP_CDN_IMG?>/intro_left.png"></a>--></div>
			<div class="intro_right"><!--<a href=""><img src="<?=G5_APP_CDN_IMG?>/intro_right.png"></a>--></div>

			<ul class="intro3_txt">
				<li><?=$member['mb_nick']?></li>
				<li>Nice to meet you!</li>
				<li>Let’s have fun solving quizzes<br/>and earning prizes.</li>
				<li>COQUIZ with Conut,<br/>Let’s go!!!<img src="<?=G5_APP_CDN_IMG?>/icon_rocket.png"><img src="<?=G5_APP_CDN_IMG?>/icon_rocket.png"></li>
			</ul>

			<div class="intro3_img">
				<div><img src="<?=G5_APP_CDN_IMG?>/intro3_1.png"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro3.png" class="tada"></div>
				<div><img src="<?=G5_APP_CDN_IMG?>/intro3_2.png"></div>
			</div>

			<div class="intro3_img2"><img src="<?=G5_APP_CDN_IMG?>/intro3_3.png"></div>
			<div class="intro3_img3"><img src="<?=G5_APP_CDN_IMG?>/intro3_4.png"></div>

			<div class="intro3_btn">
				<a href="<?=G5_APP_URL?>/box_open_new.php"><img src="<?=G5_APP_CDN_IMG?>/intro3_play_btn.png" class="smallBig3"></a>
			</div>

		</div>			
	<!--4 인트로 -->
    
	</div>

</div>
</div>

<script>
	function nft_parts_change(folder_src, file_src, parts_id) {		
		document.getElementById("6_ACCESSORY_img_div").innerHTML = "<img src='<?=G5_APP_CDN_IMG?>/nft_normal/" + folder_src + "/700/" + file_src + ".png'" + " id='6_ACCESSORY_img' style='opacity:0;' class='nft_change'>";
		
		document.getElementById("my_6_ACCESSORY").value = file_src;	
	}
	
	function my_profil_save() {	
		var my_6_ACCESSORY_value = document.getElementById("my_6_ACCESSORY").value;
		if (my_6_ACCESSORY_value == "") {
			swal_alert('Please select a part');
		} else {	
			var airdrop_parts_frame_title = "<img src ='<?=G5_APP_CDN_IMG?>/nft_normal/6_ACCESSORY/100/" + my_6_ACCESSORY_value + ".png' style='width:100px;'>Would you like to receive it?";
			var airdrop_parts_frame_url = "<?=G5_APP_URL?>/app_event.php?type_v=my_parts_airdrop&parts_detail=" + my_6_ACCESSORY_value;
			swal_alert(airdrop_parts_frame_title, 'Once received, it cannot be changed.', 'y', airdrop_parts_frame_url, 'frame');
		}
	}
	
	function last_step_move_run() {
	document.getElementById('wc_s_3').className = 'intro3 Out_to_Left';document.getElementById('wc_s_4').style.display = 'block';document.getElementById('wc_s_4').className = 'intro4 In_to_Left';
	}
	
	function last_step_move() {
		document.getElementById("finish_comment").style.display = 'block';
		setTimeout(last_step_move_run, 2000);
	}
</script>

<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
<?php
include_once('tail.sub.php');
?>