<?php
include_once('./_common.php');
$g5['title'] = '아이템 받기';
include_once('./_head.sub.php');
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>
<?php
$item_get_type = $_GET["item_get_type"];
$item_get_ea = $_GET["item_get_ea"];
//$quest_page_return = $_GET["quest_page_return"];
$quest_area = $_GET["quest_area"];
$market_area = $_GET["market_area"];
$benefit_area = $_GET["benefit_area"];

$parts_section = $_GET["parts_section"];
$parts_detail = $_GET["parts_detail"];
$upgrade_area = $_GET["upgrade_area"];
//echo $quest_area;
//die();

$pie_area = $_GET["pie_area"];
$get_goodsName = $_GET["get_goodsName"];
$get_goodsImgB = $_GET["get_goodsImgB"];

$coupon_area = $_GET["coupon_area"];

$publish_area = $_GET["publish_area"];

$nft_wallet_area = $_GET["nft_wallet_area"];

$myst_get_area = $_GET["myst_get_area"];

$roulette_get_area = $_GET["roulette_get_area"];


if ($quest_area) {
	//$item_wrap_class = "back_opacity0"; <!-- 배경이 약간 불투명으로 얹혀질때는 클래스 없음, 투명으로 얹혀질때는  클래스 back_opacity0 -->
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/quest.php?quest_area=".$quest_area."';window.parent.full_frame_close_pop();";
} else if ($market_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/market.php';window.parent.full_frame_close_pop();";
} else if ($nft_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/nft.php?nft_cat_now=ALL';window.parent.full_frame_close_pop();";
} else if ($upgrade_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.full_frame_close();";
} else if ($pie_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.full_frame_close();";
} else if ($coupon_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/coupon.php';window.parent.full_frame_close_pop();";
} else if ($publish_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.full_frame_close();";
} else if ($nft_wallet_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.full_frame_close();";
} else if ($myst_get_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/nft_verification.php';window.parent.full_frame_close_pop();";
} else if ($benefit_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_URL."/benefit.php';window.parent.full_frame_close_pop();";
} else if ($roulette_get_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.full_frame_close();";
} else if ($invite_2411_area) {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_LOBBY."?invite_2411_pop=ok';";
	//$close_pop_atcion = "window.parent.location.href='lobby_delete.php?invite_2411_pop=ok';";
} else {
	$item_wrap_class = "";
	$close_pop_atcion = "window.parent.location.href='".G5_APP_LOBBY."';window.parent.full_frame_close();";
}

switch($item_get_type){

	case "key": 
	$item_get_title = "Key";
	break;
	
	case "candy": 
	$item_get_title = "Candy";
	break;
	
	case "cookie": 
	$item_get_title = "Cookie";
	break;
	
	case "point": 
	$item_get_title = "Point";
	break;
	
	case "item": 
	$item_get_title = "Item";
	break;
	
	case "x2": 
	$item_get_title = "X2";
	$item_get_type = "double";
	break;
	
	case "parts": 
	$item_get_title = "Parts";
	break;
	
	case "pie": 
	$item_get_title = "piq";
	break;
	
	case "roulette": 
	$item_get_title = "룰렛";
	break;
	
	case "giftbox_1": 
	$item_get_title = "나무상자";
	break;
	
	case "giftbox_2": 
	$item_get_title = "강철상자";
	break;
	
	case "giftbox_3": 
	$item_get_title = "실버상자";
	break;
	
	case "giftbox_4": 
	$item_get_title = "골드상자";
	break;
	
	case "giftbox_5": 
	$item_get_title = "그랜드상자";
	break;
	
	case "giftbox_6": 
	$item_get_title = "Mystery Box";
	break;
	
	case "pieshhop": 
	$item_get_title = $get_goodsName;
	break;
	
	case "pieshop_coin": 
		if ($get_goodsName == "BTC") { $item_get_title = "비트코인"; }
		else if ($get_goodsName == "ETH") { $item_get_title = "이더리움"; }
		else if ($get_goodsName == "XRP") { $item_get_title = "리플"; }
		else if ($get_goodsName == "DOGE") { $item_get_title = "도지코인"; }	
	break;
	
	case "goods_c1": 
	$item_get_title = "코넛 굿즈 문구";
	break;
	
	case "goods_c2": 
	$item_get_title = "코넛 굿즈 베이직";
	break;
	
	case "goods_c3": 
	$item_get_title = "코넛 굿즈 스페셜";
	break;
	
	case "nft_wallet": 
	$item_get_title = "NFT 추천 지갑";
	break;
	
	case "nft_mystery_box": 
	$item_get_title = "NFT 인증";
	break;
	
	default :
	break;
}

?>
<!-- 아이프레임으로 들어갈 페이지는 상단에 아래 style이 꼭 들어가야함 -->
<style type='text/css'>
  body{background-color:transparent;}
</style> 
<!-- 아이템 패스 시작 -->
	<div id="item_wrap" class="<?=$item_wrap_class?>"> <!-- 배경이 약간 불투명으로 얹혀질때는 클래스 없음, 투명으로 얹혀질때는  클래스 back_opacity0 -->
		<div class="get_box" onClick="<?=$close_pop_atcion?>"><!-- 컨텐츠 전체박스 -->
			
			<div class="get_title_long"><?=$item_get_title?></div><!-- 한글 13자(공백/기호포함)부터는 get_title_long 클래스 / 한글 12자까지는 get_title 클래스  -->
			<br/><br/>
			<div class="get_itemBox">
				<div class="get_circle"><img src="<?=G5_APP_CDN_IMG?>/itemget_circle2.png"></div><!-- 금빛 원 -->
				<div <?php if($item_get_type == "parts") { ?>class="get_item"<?php } else { ?>class="get_item"<?php } ?> style="opacity:0;">
                <?php if($item_get_type == "parts") { ?>
                <img src="<?=G5_APP_CDN_IMG?>/nft_normal/<?=$parts_section?>/700/<?=$parts_detail?>.png" style="width:75%;">
                <?php } else if($item_get_type == "pieshop_coin") { ?><!-- 4가지 가상화폐일 경우 width는 45%로 -->
                <img src="<?=G5_APP_CDN_IMG?>/pieshop_<?=$get_goodsImgB?>.png" style="width:45%;">
                <?php } else if($item_get_type == "pieshhop") { ?>
                <img src="<?=$get_goodsImgB?>" style="width:75%;">
                <?php } else if($item_get_type == "goods_c1" or $item_get_type == "goods_c2" or $item_get_type == "goods_c3") { ?>
                <img src="<?=G5_APP_CDN_IMG?>/nft_normal/<?=$item_get_type?>.png" style="width:95%;">
                <?php } else if($item_get_type == "nft_wallet") { ?>
                <img src="<?=G5_APP_CDN_IMG?>/nft_normal/nft_wallet.png" style="width:95%;">
                <?php } else { ?>
                <img src="<?=G5_APP_CDN_IMG?>/itemget_<?=$item_get_type?>.png?ver=20241114" style="width:80%;">
                <?php } ?>
                </div>
				<!-- 아이템 / 파일명
					쿠키 : itemget_cookie
					캔디 : itemget_candy
					2배 : itemget_double
					열쇠 : itemget_key
					점수 : itemget_point
					pass카드 : itemget_pass
					시계 : itemget_time
					룰렛 : itemget_roulette
					3가지아이템 : itemget_item
					보물상자 :  itemget_giftbox_1~6
					쿠키 사이즈별 : itemget_cookie_size1 ~ 5 
				-->
				<div class="get_star_1"><img src="<?=G5_APP_CDN_IMG?>/itemget_star_1.png"></div><!-- 별 -->
				<div class="get_star_2"><img src="<?=G5_APP_CDN_IMG?>/itemget_star_2.png"></div><!-- 별 -->
				<div class="get_star_3"><img src="<?=G5_APP_CDN_IMG?>/itemget_star_2.png"></div><!-- 별 -->
			</div>
            <?php if ($item_get_ea != "none") { ?>
			<div <?php if($item_get_type == "pieshop_coin") { ?>class="get_num_coin"<?php } else { ?>class="get_num"<?php } ?>><!-- 아이템 개수 / 가상화폐 개수일 경우, 클래스명은 get_num_coin 으로 변경하고 아래 점 이미지에는 이미지태크안에 dot 클래스 추가 / item_get_test.php 참고 -->
			<?php
            $length_item_get_ea = strlen($item_get_ea);
            for ($i = 0; $i < $length_item_get_ea; $i++) {
				if ($item_get_ea[$i] == ".") {
					echo "<img src='".G5_APP_CDN_IMG."/lemon_n_dot.png' class='fadeIn_itemget dot' style='opacity:0;'>";	
				} else {
                	echo "<img src='".G5_APP_CDN_IMG."/lemon_n_".$item_get_ea[$i].".png' class='fadeIn_itemget' style='opacity:0;'>";
				}
            }
            ?>
            </div>
            <?php } ?>
            
            <br/><br/><br/><br/>

		</div>
	</div>
<!-- 아이템 패스 컨텐츠 끝 -->
<script>	
//postMessageToApp('soundStart', {file: 'sound_key_get'});
//setTimeout("postMessageToApp('soundStart', {file: 'sound_key_ea'});", 50);
</script>
<?php
include_once('./_tail.sub.php');
?>