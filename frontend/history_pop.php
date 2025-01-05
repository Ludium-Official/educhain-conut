<?php
include_once('common.php');
$g5['title'] = '내역보기';
include_once('head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>
<?php

switch($_GET["hst_section_v"]){

	case "pie":	
	$basic_title_class = "history_title_img pies";
	$basic_title_text = "Pie";
	$my_ea_piat = number_format($member["mb_pie"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_pie where mb_id = '{$member["mb_id"]}' ORDER BY pie_id DESC LIMIT 500";
	break;
	
	case "candy":	
	$basic_title_class = "history_title_img";
	$basic_title_text = "Candy";
	$my_ea_piat = number_format($member["mb_candy"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_candy where mb_id = '{$member["mb_id"]}' ORDER BY candy_id DESC LIMIT 500";
	break;
	
	case "cookie":	
	$basic_title_class = "history_title_img";
	$basic_title_text = "Cookie";
	$my_ea_piat = number_format($member["mb_cookie"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_cookie where mb_id = '{$member["mb_id"]}' ORDER BY cookie_id DESC LIMIT 500";
	break;
	
	case "point":	
	$basic_title_class = "history_title_img point";
	$basic_title_text = "Point";
	$my_ea_piat = number_format($member["mb_point"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_point where mb_id = '{$member["mb_id"]}' ORDER BY po_id DESC LIMIT 500";
	break;
	
	case "key":	
	$basic_title_class = "history_title_img keys";
	$basic_title_text = "Key";
	$my_ea_piat = number_format($member["mb_key"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_key where mb_id = '{$member["mb_id"]}' ORDER BY key_id DESC LIMIT 500";
	break;
	
	case "roulette":	
	$basic_title_class = "history_title_img rouls";
	$basic_title_text = "Roulette";
	$my_ea_piat = number_format($member["mb_roulette"]);
	$sql = "SELECT * FROM 0_edu_coquiz_g5_roulette where mb_id = '{$member["mb_id"]}' ORDER BY roulette_id DESC LIMIT 500";
	break;
	
	default :
	break;
}
//echo $sql;
$result = sql_query($sql);
?>
<!-- 아이프레임으로 들어갈 페이지는 상단에 아래 style이 꼭 들어가야함 -->
<style type='text/css'>
  body{background-color:transparent;}
</style> 
<div id="wrapper">
	
	<!-- 컨텐츠 시작 -->
	<div id="history_wrap"> <!-- 불투명 블랙배경 -->
		<div class="history_box"><!-- 컨텐츠 전체박스 -->
			
			<?php
            if ($_GET["hst_section_v"] == "candy" or $_GET["hst_section_v"] == "cookie") {
			?>
            <!-- 캔디,쿠키 타이틀 이미지 탭 -->
			<div class="<?=$basic_title_class?>">
				<ul class="cc_tab">
					<li <?php if ($_GET["hst_section_v"] == "candy") {?>class="on"<?php } ?> onclick="location.href='<?=G5_APP_URL?>/history_pop.php?hst_section_v=candy';"><img src="<?=G5_APP_CDN_IMG?>/history_candy.png"></li>
					<li <?php if ($_GET["hst_section_v"] == "cookie") {?>class="on"<?php } ?> onclick="location.href='<?=G5_APP_URL?>/history_pop.php?hst_section_v=cookie';"><img src="<?=G5_APP_CDN_IMG?>/history_cookie.png"></li>
				</ul>
			</div>
            <?php
			} else {
			?>
            <!-- 캔디,쿠키 제외한 타이틀 이미지/ 기본클래스는 history_title_img / 
			파이내역은 pies, 점수는 point, 3개아이템 내역은 item3s, 열쇠내역은 keys, 룰렛내역은 rouls
			시계는 time, pass는 pass, x2는 double 클래스 추가-->
			<div class="<?=$basic_title_class?>"></div>
            <?php
			}
			?>

			<div class="history_title_txt"><span class="historyTxt">MY <?=$basic_title_text?> <span class="historyNumber"><?=$my_ea_piat?></span></span></div><!-- 타이틀 -->
			
			<div class="history_inbox">
						<ul class="history_list">
						<?php
                        for ($i = 0; $row = sql_fetch_array($result); $i++) {
						?>
							<li><span>
							<?
							if ($_GET["hst_section_v"] == "point") {
								$piat_datetime = "po_datetime";
								$piat_content = "po_content";
								$piat_ea = "po_point";
							} else {
								$piat_datetime = $_GET["hst_section_v"]."_datetime";
								$piat_content = $_GET["hst_section_v"]."_content";
								$piat_ea = $_GET["hst_section_v"]."_ea";

							}
							
							
							$date_l_v =  substr($row[$piat_datetime],5,5);
							if ($date_l_v == $date_l_v_old) {} else {echo $date_l_v;}
							?>
                           </span></li>
							<li><span>
							<?php if ($_GET["hst_section_v"] == "point" and $row["po_rel_action"] == "quiz") {$row["po_content"] = preg_replace('/\d/', '', $row["po_content"]); echo $row["po_content"];} else {echo $row[$piat_content];} ?>
                            <?php
								if ($_GET["hst_section_v"] == "pie" and $row["pie_action_type_detail"] == "invite") {
									$invite_mem_v = get_member($row["pie_action_id"]);
									echo " - ".$invite_mem_v["mb_nick"];
								}
							?>
                            <?php
								//if ($member["mb_id"] == "admin") {echo "<br>완료 - 업비트 Ripple raQwCVAJVqjrVm1Nj5SFRcX8i22BhdC9WA 2941758125";}
								//if ($_GET["hst_section_v"] == "pie" and $row["pie_action_type"] == "pieshop_coin") {
								//	echo "<br>".$row["pie_action_type_detail"]." - ".$row['etc']; 
								//}
							?>
                            </span></li>
							<li><span><?php if($row[$piat_ea] > 0) {echo "+".number_format($row[$piat_ea]);} else {echo number_format($row[$piat_ea]);}?></span></li>
                        <?php
							$date_l_v_old =  substr($piat_datetime,5,5);
						}
						?>
                        <!--
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li><img src="<?=G5_APP_CDN_IMG?>/history_double.png"> +20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li><img src="<?=G5_APP_CDN_IMG?>/history_time.png"> +20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li><img src="<?=G5_APP_CDN_IMG?>/history_pass.png"> +20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
							<li>24/02/01 14:00</li>
							<li>코넛박스 OPEN 보상</li>
							<li>+20</li>
                        -->
						</ul>
			
			</div>

			<div class="history_close"><img src="<?=G5_APP_CDN_IMG?>/attend_close.png" onClick="window.parent.full_frame_close();"></div><!-- 닫기 -->

		</div>
	</div>
	<!-- 컨텐츠 끝 -->


<?php
include_once('tail.sub.php');
?>