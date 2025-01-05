<?php
include_once('common.php');

/*
$con_ip = $_SERVER["REMOTE_ADDR"];



if ($con_ip == "210.179.242.127" or $con_ip == "2001:4430:c069:95c9:28" or $con_ip == "59.16.9.173" or $con_ip == "110.47.91.250" or $con_ip == "211.217.234.189") {
	
} else {
	
    if ($_GET["code_vvvvvvv"] == "error") {
	} else {
		echo "<script>location.href='/app/error_1.php?code_vvvvvvv=error';</script>";
	}
	//$here_page_v = basename( $_SERVER[ "PHP_SELF" ] );
	/*if($here_page_v != "error_1.php" or $here_page_v != "app_js.php") {echo "<script>location.href='/app/error_1.php';</script>";}*/
	
/*}
*/




//if (!$is_member) {alert('로그인 후 이용해 주세요.', "/bbs/login.php");}

// 커뮤니티 사용여부
if(defined('G5_COMMUNITY_USE') && G5_COMMUNITY_USE === false) {
    if (!defined('G5_USE_SHOP') || !G5_USE_SHOP)
        die('<p>쇼핑몰 설치 후 이용해 주십시오.</p>');

    define('_SHOP_', true);
}