    <!--사탕, 쿠키-->
	<div class="section_1">
		
		<div class="Box">
			<div id="top_cpie_n">
        
					<div class="leftBox_n" id="cc_btn"><!-- 보유 쿠키/캔디 -->
						<div class="ccImg_n"></div>
						<div class="txtBox_n"><?=number_format($member["mb_candy"])?> <span class="ft_c_yellow2">I</span> <?=number_format($member["mb_cookie"])?></div>
					</div>

					<div class="rightBox_n" id="pie_btn"><!-- 보유 파이 -->
						<div class="txtBox_n"><span class="white_vod_n"><?=number_format($member["mb_pie"])?></span></div>
						<div class="pieImg_n"><img src="/0_educhain/edu_img/top_pie.png"></div>
						<!-- 알림아이콘<div class="alertT alert_vod"><span><img src="<?=G5_APP_CDN_IMG?>/icon_alert.png"></span></div> -->
					</div>

			</div>
		</div>

	</div>

<script>

// 보유 캔디,쿠키 갯수
const cc_btn = document.getElementById('cc_btn');
cc_btn.addEventListener('touchstart', (event) => {
	cc_btn.className = "leftBox_n smaller";  //leftBox 클래스 유지
});
cc_btn.addEventListener('touchend', (event) => {  
	cc_btn.className = "leftBox_n bigger"; //leftBox 클래스 유지
	setTimeout(full_frame_view("<?=G5_APP_URL?>/history_pop.php?hst_section_v=candy"), 50); //0.05초후 이동
});

// 보유 파이 갯수
const pie_btn = document.getElementById('pie_btn');
pie_btn.addEventListener('touchstart', (event) => {
	pie_btn.className = "rightBox_n smaller";  //leftBox 클래스 유지
});
pie_btn.addEventListener('touchend', (event) => {  
	pie_btn.className = "rightBox_n bigger"; //leftBox 클래스 유지
	setTimeout(full_frame_view("<?=G5_APP_URL?>/history_pop.php?hst_section_v=pie"), 50); //0.05초후 이동
});

</script>