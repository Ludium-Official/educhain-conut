<?php
include_once('common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //비회원시 메인 페이지 이동
$g5['title'] = '위핀 월렛';
include_once('head.sub.php');

//wepin api key 추가
$appId = 'OOOOOOOOOOOOOOOOO';
$appKey = 'OOOOOOOOOOOOOOOOO';
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>

<div id="wrapper">
	<div id="container">
	<!-- content start -->
    <a href="#" onClick="wepin_open();">WEPIN WALLET</a>
    <!-- content end -->
	<?php include_once(G5_APP_PATH.'/include/footer.php'); // 하단 네비 ?>
	</div>	
</div>
<script type="module">
	import { WepinSDK } from 'https://cdn.jsdelivr.net/npm/@wepin/sdk-js@latest/+esm';

	let wepinSdk;
	async function initWepin() {
		wepinSdk = new WepinSDK({
			appId: "<?php echo $appId; ?>",
			appKey: "<?php echo $appKey; ?>" 
		});
		// 위젯 초기화
		await wepinSdk.init({
			defaultLanguage: "ko",
		});
	}

	//window.onload = async () => {
	async function wepin_open() {
		try {
			await initWepin();
			console.log("Wepin Init");
			
			const status = await wepinSdk.getStatus();
			console.log(status);
			if(status === "login_before_register") {
				await register();
				await openWallet();
			}
			else if(status === "login"){
				//모든 인증 끝 - 정상 로그인
				console.log("login ok");
				await openWallet();
			}
		}
		catch (error) {
			console.error("Failed to init Wepin", error);
		}
	}

	async function register() {
		try {
			const response = await wepinSdk.register();
			console.log(response);
		}
		catch (error) {
			console.error(error);
		}
	}

	async function openWallet() {
		try {
			const response = await wepinSdk.openWidget();
			console.log(response);
		}
		catch (error) {
			console.error(error);
		}
	}
	
// 전역 스코프(window)에 등록
window.wepin_open = wepin_open;
</script>
<?php
include_once('tail.sub.php');
?>