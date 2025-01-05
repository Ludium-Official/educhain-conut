<?php
include_once('common.php');

if( function_exists('social_check_login_before') ){
    $social_login_html = social_check_login_before();
}

$g5['title'] = '로그인';
include_once('head.sub.php');

$url = isset($_GET['url']) ? strip_tags($_GET['url']) : '';
$od_id = isset($_POST['od_id']) ? safe_replace_regex($_POST['od_id'], 'od_id') : '';

// url 체크
check_url_host($url);

// 이미 로그인 중이라면
if ($is_member) {
    if ($url)
        goto_url($url);
    else
        goto_url(G5_URL);
}

$login_url        = login_url($url);
$login_action_url = G5_HTTPS_BBS_URL."/login_check.php";

add_stylesheet('<link rel="stylesheet" href="css/register_style.css">', 0);
?>
<div id="wrapper">
<div id="container">
	<div class="qz_login_wrap">
		<div class="login_img2"><img src="<?=G5_APP_CDN_IMG?>/quiz/login_img_edu.png"></div>

		 <!-- 아이디/비밀번호 입력 -->
		 <div id="mb_login" class="mbskin" style="margin-top:0px;">
                <form name="flogin" action="login_check.php" onsubmit="return flogin_submit(this);" method="post" id="flogin">
                <input type="hidden" name="url" value="<?php echo $login_url ?>">
            
                <div id="login_frm">
                    <button type="button" class="btn_submit testlogin_edu" onClick="test_login_pass();"><span>TEST Login</span></button>
					<label for="login_id" class="sound_only">ID</label>
                    <input type="text" name="mb_id" id="login_id" placeholder="ID" required class="frm_input required" maxLength="20">
                    <label for="login_pw" class="sound_only">PW</label>
                    <input type="password" name="mb_password" id="login_pw" placeholder="PW" required class="frm_input required" maxLength="20" style="margin-top:0;">                    
                    <button type="submit" class="btn_submit login_edu"><span>Login</span></button>
                    <button type="button" class="btn_submit signup_edu" onClick="location.href='register_form.php';"><span>Sign Up</span></button>
                </div>
                </form>
          </div>
		  <!-- 아이디/비밀번호 입력 -->      

		</div>

</div>
</div>
<script>
function test_login_pass() {
	document.getElementById('login_id').value = 'conutedu';
	document.getElementById('login_pw').value = 'Leechoong2!';
	document.getElementById('flogin').submit();
}
</script>
<?php
run_event('member_login_tail', $login_url, $login_action_url, $member_skin_path, $url);

include_once('tail.sub.php');
?>