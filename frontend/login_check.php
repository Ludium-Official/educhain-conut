<?php
include_once('common.php');

$g5['title'] = "로그인 검사";

$mb_id       = isset($_POST['mb_id']) ? trim($_POST['mb_id']) : '';
$mb_password = isset($_POST['mb_password']) ? trim($_POST['mb_password']) : '';

run_event('member_login_check_before', $mb_id);

if (!$mb_id || run_replace('check_empty_member_login_password', !$mb_password, $mb_id))
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

//소셜 로그인추가 체크

$is_social_login = false;
$is_social_password_check = false;

// 소셜 로그인이 맞는지 체크하고 해당 값이 맞는지 체크합니다.
if(function_exists('social_is_login_check')){
    $is_social_login = social_is_login_check();

    //패스워드를 체크할건지 결정합니다.
    //소셜로그인일때는 체크하지 않고, 계정을 연결할때는 체크합니다.
    $is_social_password_check = social_is_login_password_check($mb_id);
	//alert("social");
	//die();
}

$is_need_not_password = run_replace('login_check_need_not_password', $is_social_password_check, $mb_id, $mb_password, $mb, $is_social_login);

// $is_need_not_password 변수가 true 이면 패스워드를 체크하지 않습니다.
// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.
if (!$is_need_not_password && (! (isset($mb['mb_id']) && $mb['mb_id']) || !login_password_check($mb, $mb_password, $mb['mb_password'])) ) {

    run_event('password_is_wrong', 'login', $mb);

    alert('Please check your login information');
}

run_event('login_session_before', $mb, $is_social_login);

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . get_real_client_ip() . $_SERVER['HTTP_USER_AGENT']));
// 회원의 토큰키를 세션에 저장한다. /common.php 에서 해당 회원의 토큰값을 검사한다.
if(function_exists('update_auth_session_token')) update_auth_session_token($mb['mb_datetime']);

// 중복체크 로그인 접속 정보 저장 CONUT
$login_session = getloginsession(12);
set_session('login_session', $login_session); //렌던값을 세션에 저장
$sql= " update {$g5['member_table']} set login_session = '$login_session' where mb_id = '{$mb['mb_id']}' ";
sql_query($sql);

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

// 3.26
// 아이디 쿠키에 한달간 저장
if (isset($auto_login) && $auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

if ($url) {
    // url 체크
    check_url_host($url, '', G5_URL, true);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    $post_check_keys = array('mb_id', 'mb_password', 'x', 'y', 'url');
    
    //소셜 로그인 추가
    if($is_social_login){
        $post_check_keys[] = 'provider';
    }

    $post_check_keys = run_replace('login_check_post_check_keys', $post_check_keys, $link, $is_social_login);

    foreach($_POST as $key=>$value) {
        if ($key && !in_array($key, $post_check_keys)) {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }

} else  {
    $link = G5_URL;
}
	$appId = 'OOOOOOOOOOOOOOOOO';
	$appKey = 'OOOOOOOOOOOOOOOOO';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Website</title>
</head>
<body>
<script type="module">
        // 1. 패키지 import
        import { WepinLogin } from 'https://cdn.jsdelivr.net/npm/@wepin/login-js@latest/+esm';
        import { WepinSDK } from 'https://cdn.jsdelivr.net/npm/@wepin/sdk-js@latest/+esm';

        // 전역에서 참조할 수 있도록 변수 선언
        let wepinLogin;
        let wepinSdk;

        document.addEventListener("DOMContentLoaded", async () => { //페이지 로딩 완료 후
            wepinLogin = new WepinLogin({
                appId: "<?php echo $appId; ?>",
                appKey: "<?php echo $appKey; ?>"
            });

            wepinSdk = new WepinSDK({
                appId: "<?php echo $appId; ?>",  // PHP에서 설정한 App ID
                appKey: "<?php echo $appKey; ?>" // PHP에서 설정한 App Key
            });

            await wepinLogin.init({
                defaultLanguage: "en",
            });

            await wepinSdk.init({
                defaultLanguage: "en",
            });
			
			setTimeout(handleSignUp(), 500); //0.5초후 wepin login 자동 실행			 
        });
		
        // 회원가입 / 로그인 처리 로직을 함수로 분리
        async function handleSignUp() {
			//window.alert("a");
            //event.preventDefault(); // 폼 기본 동작 방지

            const email = "OOOOOOOOOOOOOOOOO";
            const password = "OOOOOOOOOOOOOOOOO";
			/*
            if (!email || !password) {
                alert('Email and password are required.');
                return;
            }
			*/

            try {
                // 회원가입 진행
                const response = await wepinLogin.signUpWithEmailAndPassword(email, password);
                console.log(response);
                //alert(response);
            } catch (error) {
                if (error.message === 'auth/email-verified') {
                    // 회원가입 후 이메일 인증 필요 시 알림
                    alert("Please verify your email.");//이메일 확인 안 한 경우
					location.href = "logout.php";
                } else if (error.message === 'auth/existed-email') {
                    // 이미 가입되어 있는 이메일의 경우 로그인 진행
                    try {
                        const loginResponse = await wepinLogin.loginWithEmailAndPassword(email, password);
                        console.log("loginResponse: ", loginResponse);
                        const userInfo = await wepinLogin.loginWepin(loginResponse);
                        console.log("userInfo: ", userInfo);
						
                        // 이메일 확인한 후 pin 등록 진행 --------------						
                        const userStatus = userInfo.userStatus;
                        console.log("userStatus: ", userStatus);
                        if (userStatus.loginStatus === 'pinRequired' || userStatus.loginStatus === 'registerRequired') {
                            // wepin register
                            const response = await wepinSdk.register();
                            console.log(response);
                        }
						// 이메일 확인한 후 pin 등록 진행 --------------
                        
                        // 지갑 주소 가져오기
                        const walletAddress = await wepinSdk.getAccounts();
                        console.log("total wallet address : ", walletAddress);
                        
                        const eduAddress = await wepinSdk.getAccounts({
                            networks: ['evmOpenCampus-Testnet'], 
                            withEoa: true
                        });
                        console.log("educhain wallet address : ", eduAddress[0].address);
						//document.getElementById("app_action_frame").src = "<?=G5_APP_URL?>/app_event.php?type_v=wepin_wallet_update&wepin_addr="+eduAddress[0].address;
                        
                        
						// 로컬 스토리지 값 가져오기
                        let storageValue = localStorage.getItem("wepin:auth:fabc3e2b39b96fb214dbd3f027ed1726");

                        if (storageValue) {
                            let parsed = JSON.parse(storageValue);
                            
                            console.log("[localStorage] firebase:wepin.provider : ", parsed["firebase:wepin"].provider);
                            console.log("[localStorage] firebase:wepin.idToken : ", parsed["firebase:wepin"].idToken);
                            console.log("[localStorage] firebase:wepin.refreshToken : ", parsed["firebase:wepin"].refreshToken);
                            console.log("[localStorage] wepin:connectUser.accessToken : ", parsed["wepin:connectUser"].accessToken);
                            console.log("[localStorage] wepin:connectUser.refreshToken : ", parsed["wepin:connectUser"].refreshToken);
                            console.log("[localStorage] user_id : ", parsed.user_id);
                            console.log("[localStorage] user_info.status : ", parsed.user_info.status);
                            console.log("[localStorage] user_info.userInfo.userId : ", parsed.user_info.userInfo.userId);
                            console.log("[localStorage] user_info.userInfo.email : ", parsed.user_info.userInfo.email);
                            console.log("[localStorage] user_info.userInfo.provider : ", parsed.user_info.userInfo.provider);
                            console.log("[localStorage] user_info.userInfo.use2FA : ", parsed.user_info.userInfo.use2FA);
                            console.log("[localStorage] user_info.walletId : ", parsed.user_info.walletId);
                            console.log("[localStorage] user_status.loginStatus : ", parsed.user_status.loginStatus);
                            console.log("[localStorage] user_status.pinRequired : ", parsed.user_status.pinRequired);
                            console.log("[localStorage] wallet_id : ", parsed.wallet_id);
                            console.log("[localStorage] oauth_provider_pending : ", parsed.oauth_provider_pending);
							
							//location.href='<?=G5_APP_LOBBY?>'; //로비 이동
                        } else {
                            console.log("localStorage에 key 'A'가 존재하지 않습니다.");
                        }
						
						
						setTimeout("location.href='<?=G5_APP_LOBBY?>';", 500); //0.5초후 로비 이동
                    } catch (error) {
                        console.error(error);
                        alert(error);
						location.href = "logout.php";
                    }
                } else {
					console.error(error);
					alert(error);
					location.href = "logout.php";
                }
            }
        };
</script>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
</body>
</html>