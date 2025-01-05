<?php
include_once('./_common.php');
$g5['title'] = '프로필 보기';
include_once('./_head.sub.php');

$member_pop_info = get_member($_GET["member_pid_v"]);

function containsDomain($string, $domain) {
	// 도메인을 정규 표현식 패턴으로 변환
	$pattern = "/\b" . preg_quote($domain, '/') . "\b/";
						
	// 정규 표현식으로 일치하는 부분이 있는지 확인
	return preg_match($pattern, $string);
}
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>
<!-- 아이프레임으로 들어갈 페이지는 상단에 아래 style이 꼭 들어가야함 -->
<style type='text/css'>
  body{background-color:transparent;}
</style> 
<div id="wrapper">
	
	<div id="prof_wrap"> <!-- 불투명 블랙배경 -->
		<div class="prof_box"><!-- 컨텐츠 전체박스/흰박스+닫기버튼 -->
			
			<div class="prof_inbox">
				<ul class="prof_spec">
					<li><img src="member_conut/360/<?=$member_pop_info["mb_id"]?>.png?ver=<?=time()?>"></li>
                    <?php
								$sql = "SELECT COUNT(*) AS rank FROM 0_edu_coquiz_g5_member WHERE mb_point > {$member_pop_info['mb_point']} and mb_leave_date = '' and mb_level = 2 ";
								//echo $sql; 
								$pop_id_rank = sql_fetch($sql);
								$pop_id_rank = $pop_id_rank["rank"]+1;	
								
								if ($member_pop_info["mb_homepage"]) {
									
									$member_pop_info["mb_homepage"] = set_http($member_pop_info["mb_homepage"]);
									
									$member_pop_homepage = "<a href='".$member_pop_info["mb_homepage"]."?app_open_target=blank' target='_blank'>";
									
										if (containsDomain($member_pop_info["mb_homepage"],"kakao.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_cc.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"x.com") or containsDomain($member_pop_info["mb_homepage"],"twitter.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_x.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"instagram.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_insta.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"naver.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_naver.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"youtube.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_you.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"opensea.io")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_os.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"facebook")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_fb.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"tiktok.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tt.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"t.me")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tele.png'>";}
										else if (containsDomain($member_pop_info["mb_homepage"],"tistory.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_ts.png'>";}	
										else {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_home.png'>";}
									
									$member_pop_homepage = $member_pop_homepage."</a>";
								}
								
								if ($pop_id_rank == "1") {$this_mem_rank = "<img src='".G5_APP_CDN_IMG."/ranking_1st.png'>";}
								else if ($pop_id_rank == "2") {$this_mem_rank = "<img src='".G5_APP_CDN_IMG."/ranking_2nd.png'>";}
								else if ($pop_id_rank == "3") {$this_mem_rank = "<img src='".G5_APP_CDN_IMG."/ranking_3rd.png'>";}
								else {$this_mem_rank = "<div class='pf_ranking'>".$pop_id_rank."</div>";}
					?>
					<li>
							<ul class="pf_rname">
								<li><!-- 랭킹 --><?=$this_mem_rank?></li>
								<li><?=$member_pop_info["mb_nick"]?> <?=$member_pop_homepage?></li>
							</ul>
					</li>
					<li><?=$member_pop_info["mb_profile"]?></li>
				</ul>
                    <?php
								$sql = "select sum(pie_ea) as pie from 0_edu_coquiz_g5_pie where mb_id = '{$member_pop_info['mb_id']}'";
								//echo $sql;
								$pop_id_pie = sql_fetch($sql);								
					?>
                <!--    
				<ul class="prof_spec4">
					<li>누적 파이 <img src="<?=G5_APP_CDN_IMG?>/top_pie.png"> <?=number_format($pop_id_pie['pie'])?></li>
				</ul>
                -->
				<!--
				<ul class="prof_spec3">
					<li><span>초대코드 : andzms</span></li>
					<li><a href="">초대문구 복사</a></li>
				</ul>
				-->
			</div>

			<div class="prof_close"><img src="<?=G5_APP_CDN_IMG?>/attend_close.png" onClick="window.parent.full_frame_close();"></div><!-- 닫기 -->

		</div>
	</div>

</div>
	<!-- 열쇠획득 컨텐츠 끝 -->
<?php
include_once('./_tail.sub.php');
?>