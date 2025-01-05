<?php
include_once('common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //CONUT 비회원시 메인 페이지 이동

$g5['title'] = '로비';
include_once('head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>

<div id="wrapper">
	<div id="container">

				
				<?php include_once(G5_APP_PATH.'/include/header.php'); // 상단 보유 쿠키 캔디 ?>
				
				<!-- ============ 가운데 영역 세로 79% =========== 시작 -->
				<div class="lobby_in">
					<!-- ====== 가운데 영역 세로 중앙정렬 시작 ====== -->
					<div class="lobby_inbox">
					
                        <!-- 프로필 -->
						<div class="section_2_n">
								<div class="Spec_n">
									
									<div class="Left">
										<!-- 사진 -->
										<div class="Profile_n">
											<img src="member_conut/360/<?=$member["mb_id"]?>.png?ver=<?=time()?>"  id="pf_btn"><br/>
											<!--<img src="/0_v1_img/test_coquiz.png?ver=<?=time()?>"><br/>-->
											<div style="position:relative;"><img src="<?=G5_APP_CDN_IMG?>/btn_nft_certifi.png?ver=<?=time()?>" class="nft_img" id="nft_btn"><!--<div class="alertT alert_certifi"><span><img src="<?=G5_APP_CDN_IMG?>/icon_alert.png"></span></div>--></div>
										</div>
									</div>
									
									<div class="Right">
										<!-- 랭킹/닉네임 -->
										<div class="Right_in">
											<div class="Ranking_name_n">
												<?php
												$sql = "SELECT COUNT(*) AS rank FROM 0_edu_coquiz_g5_member WHERE mb_level = 2 AND mb_leave_date = '' and mb_point > {$member['mb_point']}";
												$my_rank = sql_fetch($sql);
												$my_rank = $my_rank["rank"]+1;
												?>
												<a href="#" onClick="location.href='<?=G5_APP_URL?>/ranking.php';"><div class="Ranking_n"><?=$my_rank?></div></a>
												<div class="Name_n">
													<span><?=$member["mb_nick"]?></span> <a href="#" onClick="cqz_member_logout();"><img src="<?=G5_APP_CDN_IMG?>/logout.png" alt="logout" class="logout"></a><br/>
													<div class="Point_n"><a href="#" onClick="full_frame_view('<?=G5_APP_URL?>/history_pop.php?hst_section_v=point');"><img src="<?=G5_APP_CDN_IMG?>/money.png?ver=241113"><?=number_format($member["mb_point"])?></a></div><?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a><?php }  ?></div>
											</div>
											<!-- 보유 아이템 -->
											<ul class="Have_n">
												<li id="myTime_btn"><img src="<?=G5_APP_CDN_IMG?>/watch.png" alt="pass"><br class="mo_br"/><?=$member["mb_time"]?></li>
												<li id="myPass_btn"><img src="<?=G5_APP_CDN_IMG?>/pass_card.png" alt="time"><br class="mo_br"/><?=$member["mb_pass"]?></li>
												<li id="myDouble_btn"><img src="<?=G5_APP_CDN_IMG?>/double.png" alt="x2"><br class="mo_br"/><?=$member["mb_x2"]?></li>
											</ul>
											</div>
									</div>

							</div>
						</div>

						<!-- 보유 키/광고/세팅/알림 -->
						<div class="section_3_n">
							<div class="Box_n">
								<!-- 보유 키/광고 -->
								<div class="haveKey_n" id="haveKey_n_btn">
									<div class="key_n"><img src="<?=G5_APP_CDN_IMG?>/attend_key.png"></div>
									<div class="txt_n"><span class="yellow_key_n"><?=$member["mb_key"]?></span> / <span class="white_vod_n">10</span></div>
                    	<?php
						$sql_admob_count = sql_fetch(" SELECT admob_count,admob_datetime FROM coquiz_g5_admob WHERE mb_id = '{$member["mb_id"]}' and admob_type = 'lobby_key_ad' ORDER BY admob_id DESC LIMIT 1");
						$etc_ad_count = 5 - $sql_admob_count["admob_count"];
						$targetDate = $sql_admob_count["admob_datetime"]; //마지막 광고시청 시간
						//echo "마지막 광고 시간 ".$targetDate."<br>";
						
						if ($sql_admob_count["admob_count"]) {
							$targetDate_timestamp = mktime(substr($targetDate, 11, 2), substr($targetDate, 14, 2), substr($targetDate, 17, 2), substr($targetDate, 5, 2), substr($targetDate, 8, 2), substr($targetDate, 0, 4)); //마지막 광고시청 시간 timestamp
							
							//echo "마지막 광고 시간2 ".$targetDate_timestamp."<br>";
						} else {
							$targetDate_timestamp = 0;
						}
											
						if($etc_ad_count == 0 ) {
							$etc_ad_count = 5;					
							//$targetDate_timestamp = $targetDate_timestamp + 60 * 3 ; //3분 이후
							$targetDate_timestamp = $targetDate_timestamp + 60 * 60 * 8; //8시간 이후
						} else {
							//$targetDate_timestamp = $targetDate_timestamp + 60 * 1; // 1분 이후
							$targetDate_timestamp = $targetDate_timestamp + 30 * 1; // 30초 이후
						}
						
						//echo "마지막 광고 시간 보정 ".$targetDate_timestamp."<br>";							
					
						$nowDATE_timestamp = time();
						$readyDATE_timestamp = $targetDate_timestamp - $nowDATE_timestamp;
						
						//echo "광고 오픈시간까지 ".$readyDATE_timestamp."<br>";
						
						if ($readyDATE_timestamp < 0) {
							$ad_get_alert_class = " swing_vod";
						}
?>
									<div class="ytube_n <?=$ad_get_alert_class?>"><img src="<?=G5_APP_CDN_IMG?>/icon_youtube.png"></div>
									<!--<div class="ytube swing_vod"><img src="<?=G5_APP_CDN_IMG?>/icon_youtube.png" onClick="postMessageToApp('soundStart', {file: 'sound_0_0'});postMessageToApp('admobCall', {mb_id: '<?=$member["mb_id"]?>', ad_type: 'key'});"></div>--><!-- 광고 있을때 swing_vod 클래스 -->
									<!--<div class="alertT alert_vod"><span><img src="<?=G5_APP_CDN_IMG?>/icon_alert.png"></span></div>-->
								</div>
								
								<!-- 설정 -->
								<ul class="icon_Setting_n">
									 <li id="setting_btn"><img src="<?=G5_APP_CDN_IMG?>/setting_n.png" alt="setting"></li> <!-- 설정 아이콘 -->
								</ul>
                                
							</div>
						</div>
						
						
						<div class="section_4_n">
								<!-- 보물상자 -->
								<div class="Box_n">
									<ul>
										<?php
										$nowDATE_timestamp = time();
										$sql = "SELECT * from 0_edu_coquiz_g5_box where mb_id = '".$member['mb_id']."' AND box_open = '0' order by box_id desc limit 5 ";
										$result = sql_query($sql);
										for ($i = 0; $row = sql_fetch_array($result); $i++) {
											$targetDate = $row["box_datetime"]; //상자 획득 시간
											$targetDate_timestamp = mktime(substr($targetDate, 11, 2), substr($targetDate, 14, 2), substr($targetDate, 17, 2), substr($targetDate, 5, 2), substr($targetDate, 8, 2), substr($targetDate, 0, 4)); //상자 획득 timestamp
											
											// 상자 종류별 OPEN시간 설정
											switch($row["box_type"]) {
												case "1": //5분
													$targetDate_timestamp = $targetDate_timestamp + 300;
												break;
												
												case "2": //10분
													$targetDate_timestamp = $targetDate_timestamp + 600;
												break;
												
												case "3": //20분
													$targetDate_timestamp = $targetDate_timestamp + 1200;
												break;
												
												case "4": //60분
													$targetDate_timestamp = $targetDate_timestamp + 3600;
												break;
												
												case "5": //120분
													$targetDate_timestamp = $targetDate_timestamp + 7200;
												break;
												
												case "6":
													$targetDate_timestamp = $targetDate_timestamp + 0; //최고 등급 상자 즉시 오픈!
												break;
											}
											
											$readyDATE_timestamp = $targetDate_timestamp - $nowDATE_timestamp;
											//$box_open_value = $readyDATE_timestamp;
											
											if ($readyDATE_timestamp > 0) {
												//round($readyDATE_timestamp);
												$box_count_no++;
												$box_open_status_js = $box_open_status_js."box_open_countdown('countdown_".$box_count_no."', ".round($readyDATE_timestamp).");"; 
												$box_open_status = "<span id='countdown_".$box_count_no."'></span>"; 
												
											} else {
												$box_open_status = "오픈 키-1";
											}
											
										?>
										<li><div><img src="<?=G5_APP_CDN_IMG?>/giftbox_<?=$row['box_type']?>.png" alt="코넛상자" onClick="box_open_key_check('<?=$row['box_type']?>','<?=$row['box_id']?>');" id="my_box_id_<?=$row['box_id']?>"></div><?php //echo $box_open_status?></li><!--postMessageToApp('soundStart', {file: 'sound_1'});-->
										<?php } ?>
										
										<?php //남은 인벤 채우기
										for ($i_c = $i; $i_c <=4; $i_c++) {
										?>
										<li><div class="gray"><a href="#"><img src="<?=G5_APP_CDN_IMG?>/giftbox_5.png" alt="코넛상자"></a></div></li>
										<?php } ?>
									</ul>
								</div>
						</div>

						<div class="section_5_n" id="season_btn">
							<!-- 상금의 주인공이 되어보세요! -->
							<?php
							$sql = "SELECT * FROM coquiz_g5_season where season_start < '{$now_ymdhis_v}' AND season_end > '{$now_ymdhis_v}'";
							$seaon_info = sql_fetch($sql);
							?>
							<div class="Box_n">
								<ul>
									<li>
									<div class="txt_n"><span class="title_n2">COQUIZ X EDU Chain</span><!--<span class="title_n">코퀴즈 시즌 <?=$seaon_info["season_no"]?></span><br/><span class="explain_n"><?=substr($seaon_info["season_start"],5,8)?>시 ~ <?=substr($seaon_info["season_end"],5,8)?>시</span>--></div>
									<div class="time_n"></div><!--<div class="time_txt_n"><?=substr($seaon_info["season_start"],5,5)?> ~ <?=substr($seaon_info["season_end"],5,5)?></div>-->
									</li>
								</ul>
							</div>
						</div>
					
					</div>
					<!-- ====== 가운데 영역 세로 중앙정렬 끝 ====== -->
				</div>
				<!-- ============ 가운데 영역 세로 79% =========== 끝 -->
				
				
				<div class="section_8"><?php include_once(G5_APP_PATH.'/include/footer.php'); // 하단 네비 ?></div>

	</div>
</div>
<script>
// 프로필 사진
const pf_btn = document.getElementById('pf_btn');
pf_btn.addEventListener('touchstart', (event) => {
	pf_btn.className = "smaller";
});
pf_btn.addEventListener('touchend', (event) => {  
	pf_btn.className = "bigger";
	setTimeout("location.href='<?=G5_APP_URL?>/nft.php?nft_cat_now=ALL';", 50); //0.05초후 이동
});

// NFT인증
const nft_btn = document.getElementById('nft_btn');
nft_btn.addEventListener('touchstart', (event) => {
	nft_btn.className = "nft_img smaller";  
});
nft_btn.addEventListener('touchend', (event) => {  
	nft_btn.className = "nft_img bigger"; //클래스 변경
	setTimeout("location.href='<?=G5_APP_URL?>/nft_verification.php';", 50); //0.05초후 이동
});

// 광고 
const haveKey_n_btn = document.getElementById('haveKey_n_btn');
haveKey_n_btn.addEventListener('touchstart', (event) => {
	haveKey_n_btn.className = "haveKey_n smaller"; 
});
haveKey_n_btn.addEventListener('touchend', (event) => {  
	haveKey_n_btn.className = "haveKey_n bigger";
	//setTimeout("location.href='<?=G5_APP_URL?>/ad_key.php';", 50); //0.05초후 이동
});


// 설정
const setting_btn = document.getElementById('setting_btn');
setting_btn.addEventListener('touchstart', (event) => {
	setting_btn.className = "smaller";  
});
setting_btn.addEventListener('touchend', (event) => {  
	setting_btn.className = "bigger";
	//setTimeout("location.href='<?=G5_APP_URL?>/setting.php';", 50); //0.05초후 이동
});

// 코퀴즈 시즌
const season_btn = document.getElementById('season_btn');
season_btn.addEventListener('touchstart', (event) => {
	season_btn.className = "section_5_n smaller";  //section_5_n 클래스 유지
});
season_btn.addEventListener('touchend', (event) => {  
	season_btn.className = "section_5_n bigger"; //section_5_n 클래스 유지
	setTimeout("location.href='<?=G5_APP_URL?>/ranking.php';", 50); //0.05초후 이동
});

function box_open_key_check(box_type, box_id) {

	var open_box_id_v = "my_box_id_" + box_id;
	document.getElementById(open_box_id_v).setAttribute('onClick', '#');
	document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=box_open_key_check&box_type="+box_type+"&box_id="+box_id;
}

function box_open_countdown(elementId, seconds){ //박스 오픈 카운트다운
	  var element, endTime, hours, mins, msLeft, time;

	  function updateTimer(){
		msLeft = endTime - (+new Date);
		if ( msLeft < 0 ) {
		  //console.log('done');
		  //window.alert("카운트 종료");
		  document.getElementById(elementId).innerHTML = "오픈 키-1";
		} else {
		  time = new Date( msLeft );
		  hours = time.getUTCHours();
		  mins = time.getUTCMinutes();
		  element.innerHTML = (hours ? hours + ':' + ('0' + mins).slice(-2) : mins) + ':' + ('0' + time.getUTCSeconds()).slice(-2);
		  setTimeout( updateTimer, time.getUTCMilliseconds());
		}
	  }

	  element = document.getElementById(elementId);
	  endTime = (+new Date) + 1000 * seconds;
	  updateTimer();
}

function cqz_member_logout() {
	wepin_wallet_logout();
	setTimeout(location.href='logout.php', 500); //0.5초후 이동  
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

window.onload = function(){
	
	<?php if ($_GET["item_get_type"] and $_GET["item_get_ea"]) { ?>//아이템 수령
	full_frame_view("<?=G5_APP_URL?>/item_get.php?item_get_type=<?=$_GET["item_get_type"]?>&item_get_ea=<?=$_GET["item_get_ea"]?>");
	<?php } ?>
		
}
</script>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
<?php
include_once('tail.sub.php');
?>