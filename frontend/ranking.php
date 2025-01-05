<?php
include_once('common.php');
if($is_guest) {goto_url(G5_APP_URL."/index.php");} //비회원시 메인 페이지 이동
$g5['title'] = '퀴즈 랭킹';
include_once('head.sub.php');

function containsDomain($string, $domain) {
	// 도메인을 정규 표현식 패턴으로 변환
	$pattern = "/\b" . preg_quote($domain, '/') . "\b/";						
	// 정규 표현식으로 일치하는 부분이 있는지 확인
	return preg_match($pattern, $string);
}
?>

<?php include_once(G5_APP_PATH.'/include/header_hd.php'); // 상단 hd ?>


<div id="wrapper">
<div id="container" class="ranking_Nback">

<div class="ranking_wrap">
	<div class="ranking_Title">
		<ul>
			<li><img src="<?=G5_APP_CDN_IMG?>/ranking_title_img.png"></li>
			<li><span>Hackathon</span></li>
			<li><span>EDU Chain</span></li>
		</ul>
	</div> 

	<div class="rankingWrap2">
    		<!-- EDU 상금 지급 버튼 -->
            <?php if($member["mb_id"] == "conutedu") { ?><div class="edu_prize_btn"><input value="createProgram" type="button" onClick="createProgram();"> <input value="EDU prize transfer" type="button" onClick="distribute();"></div><?php } ?>
			<!-- 내 순위 -->
			<div class="rankingMy">
			<?php
            $sql = "SELECT COUNT(mb_id) AS rank FROM 0_edu_coquiz_g5_member WHERE mb_level = 2 AND mb_leave_date = '' and mb_point > {$member['mb_point']} ORDER BY mb_point";
            $my_rank = sql_fetch($sql);
            $my_rank = $my_rank["rank"]+1;
         
                    if ($my_rank == 1) {
                        $rank_pie_value = 0.0005;
                    } else if ($my_rank == 2 ) {
                        $rank_pie_value = 0.0003;
                    } else if ($my_rank == 3 ) {
                        $rank_pie_value = 0.0002;			
                    } else if ($my_rank == 4 ) {
                        $rank_pie_value = 0.0001;			
                    } else if ($my_rank == 5 ) {
                        $rank_pie_value = 0.00005;
                    } else if ($my_rank == 6 ) {
                        $rank_pie_value = 0.00004;
                    } else if ($my_rank == 7 ) {
                        $rank_pie_value = 0.00003;
                    } else if ($my_rank == 8 ) {
                        $rank_pie_value = 0.00002;
                    } else if ($my_rank == 9 ) {
                        $rank_pie_value = 0.00001;
                    } else if ($my_rank == 10 ) {
                        $rank_pie_value = 0.000005;
                    } 
								if ($member["mb_homepage"]) {
									
										if (containsDomain($member["mb_homepage"],"kakao.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_cc.png'>";}
										else if (containsDomain($member["mb_homepage"],"x.com") or containsDomain($member["mb_homepage"],"twitter.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_x.png'>";}
										else if (containsDomain($member["mb_homepage"],"instagram.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_insta.png'>";}
										else if (containsDomain($member["mb_homepage"],"naver.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_naver.png'>";}
										else if (containsDomain($member["mb_homepage"],"youtube.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_you.png'>";}
										else if (containsDomain($member["mb_homepage"],"opensea.io")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_os.png'>";}
										else if (containsDomain($member["mb_homepage"],"facebook")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_fb.png'>";}
										else if (containsDomain($member["mb_homepage"],"tiktok.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tt.png'>";}
										else if (containsDomain($member["mb_homepage"],"t.me")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tele.png'>";}
										else if (containsDomain($member["mb_homepage"],"tistory.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_ts.png'>";}	
										else {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_home.png'>";}
										
								}

				?>
				<ul onClick="full_frame_view('<?=G5_APP_URL?>/profile_pop.php?member_pid_v=<?=$member["mb_id"]?>');">
					<li><span><?=$my_rank?></span></li>
					<li><img src="member_conut/120/<?=$member["mb_id"]?>.png?ver=<?=time()?>"></li>
					<li><span><?=$member["mb_nick"]?><?=$member_pop_homepage?></span></li>
					<li>
						<!-- 내 파이,포인트 -->
						<div class="ranking_Myhave">
							<div class="ranking_Mypie">
                            	<?php
								if ($member["nft_c2"] > 0 or $member["nft_c3"] > 0) { $my_pie_nft_x2 = " x2"; $rank_pie_value = $rank_pie_value * 2;} else {$my_pie_nft_x2 = "";}
								?>
								<div class="txt<?=$my_pie_nft_x2?>"><?=$rank_pie_value?></div>
								<div class="img"><img src="<?=G5_APP_CDN_IMG?>/attend_pie.png"></div>
							</div>
							<div class="ranking_Mypoint">
								<div class="txt"><?=number_format($member['mb_point'])?></div>
								<div class="img"><img src="<?=G5_APP_CDN_IMG?>/money.png?ver=241113"></div>
							</div>
						</div>
					</li>
				</ul>

			</div>

			<div class="ranking_3_Wrap">
			<?php 
            $sql = " SELECT mb_id,mb_nick,mb_point,mb_homepage,nft_c2,nft_c3 FROM 0_edu_coquiz_g5_member WHERE mb_level = 2 AND mb_point and mb_leave_date = '' ORDER BY mb_point DESC LIMIT 10";
            $result = sql_query($sql);
            
            for ($i = 0; $row = sql_fetch_array($result); $i++) { 
            
                if ($i == 0) {
                    $img_style_rank_v = "ranking_1st";
                    $rank_pie_value = 0.0005;
                } else if ($i == 1) {
                    $img_style_rank_v = "ranking_2nd";
                    $rank_pie_value = 0.0003;
                } else if ($i == 2) {
                    $img_style_rank_v = "ranking_3rd";
                    $rank_pie_value = 0.0002;
                } 
		
								$member_pop_homepage = "";
								if ($row["mb_homepage"]) {
									
										if (containsDomain($row["mb_homepage"],"kakao.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_cc.png'>";}
										else if (containsDomain($row["mb_homepage"],"x.com") or containsDomain($row["mb_homepage"],"twitter.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_x.png'>";}
										else if (containsDomain($row["mb_homepage"],"instagram.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_insta.png'>";}
										else if (containsDomain($row["mb_homepage"],"naver.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_naver.png'>";}
										else if (containsDomain($row["mb_homepage"],"youtube.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_you.png'>";}
										else if (containsDomain($row["mb_homepage"],"opensea.io")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_os.png'>";}
										else if (containsDomain($row["mb_homepage"],"facebook")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_fb.png'>";}
										else if (containsDomain($row["mb_homepage"],"tiktok.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tt.png'>";}
										else if (containsDomain($row["mb_homepage"],"t.me")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tele.png'>";}
										else if (containsDomain($row["mb_homepage"],"tistory.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_ts.png'>";}	
										else {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_home.png'>";}

								}

			?>
				<!-- 1~3순위 -->
				<ul class="ranking_3 <?=$img_style_rank_v?>" onClick="full_frame_view('<?=G5_APP_URL?>/profile_pop.php?member_pid_v=<?=$row["mb_id"]?>');">
					<li>
						<div class="badge"><img src="<?=G5_APP_CDN_IMG?>/<?=$img_style_rank_v?>.png"></div>
						<img src="member_conut/360/<?=$row["mb_id"]?>.png?ver=<?=date("Ymd",time())?>">
					</li>
					<li><span><?=$row["mb_nick"]?><?=$member_pop_homepage?></span></li>
					<li>
						<div class="ranking_3pie">
                               <?php
								if ($row["nft_c2"] > 0 or $row["nft_c3"] > 0) { $top3_pie_nft_x2 = " x2"; $rank_pie_value = $rank_pie_value * 2;} else {$top3_pie_nft_x2 = "";}
								?>
							<div class="txt<?=$top3_pie_nft_x2?>"><?=$rank_pie_value?></div>
							<div class="img"><img src="<?=G5_APP_CDN_IMG?>/attend_pie.png"></div>
						</div>
						<div class="ranking_3point">
							<div class="txt"><?=number_format($row['mb_point'])?></div>
							<div class="img"><img src="<?=G5_APP_CDN_IMG?>/money.png?ver=241113"></div><!-- 초대 탭에서 나오는 초대아이콘은 ranking_list_invite.png -->
						</div>
					</li>
				</ul>

			<?php 
                if ($i == 2) {
                	break;
                } 
            }
			?>

			</div>
			<?php 	
            $total_rank_vv = 4;
            for ($i = 0; $row = sql_fetch_array($result); $i++) { 
            $total_rank_v = $total_rank_vv + $i;         
				
				if ($total_rank_v == 4 ) {
                    $rank_pie_value = 0.0001;			
                } else if ($total_rank_v == 5 ) {
                    $rank_pie_value = 0.00005;
                } else if ($total_rank_v == 6 ) {
                    $rank_pie_value = 0.00004;
                } else if ($total_rank_v == 7 ) {
                    $rank_pie_value = 0.00003;
                } else if ($total_rank_v == 8 ) {
                    $rank_pie_value = 0.00002;
                } else if ($total_rank_v == 9 ) {
                    $rank_pie_value = 0.00001;
                } else if ($total_rank_v == 10 ) {
                    $rank_pie_value = 0.000005;
                } 
					
								$member_pop_homepage = "";
								if ($row["mb_homepage"]) {
																		
										if (containsDomain($row["mb_homepage"],"kakao.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_cc.png'>";}
										else if (containsDomain($row["mb_homepage"],"x.com") or containsDomain($row["mb_homepage"],"twitter.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_x.png'>";}
										else if (containsDomain($row["mb_homepage"],"instagram.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_insta.png'>";}
										else if (containsDomain($row["mb_homepage"],"naver.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_naver.png'>";}
										else if (containsDomain($row["mb_homepage"],"youtube.com")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_you.png'>";}
										else if (containsDomain($row["mb_homepage"],"opensea.io")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_os.png'>";}
										else if (containsDomain($row["mb_homepage"],"facebook")) {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_fb.png'>";}
										else if (containsDomain($row["mb_homepage"],"tiktok.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tt.png'>";}
										else if (containsDomain($row["mb_homepage"],"t.me")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_tele.png'>";}
										else if (containsDomain($row["mb_homepage"],"tistory.com")) {$member_pop_homepage = $member_pop_homepage."<img width='25' src='".G5_APP_CDN_IMG."/pf_ts.png'>";}	
										else {$member_pop_homepage = $member_pop_homepage."<img src='".G5_APP_CDN_IMG."/pf_home.png'>";}
										
								}

			?>		
    		<ul class="rankingList" onClick="full_frame_view('<?=G5_APP_URL?>/profile_pop.php?member_pid_v=<?=$row["mb_id"]?>');">
				<li><span><?=$total_rank_v;?></span></li>
				<li><img src="member_conut/120/<?=$row["mb_id"]?>.png?ver=<?=date("Ymd",time())?>"></li>
				<li><span><?=$row["mb_nick"]?><?=$member_pop_homepage?></span></li>
				<li>
					<div class="ranking_point">
						<div class="txt"><?=number_format($row['mb_point'])?></div>
						<div class="img"><img src="<?=G5_APP_CDN_IMG?>/money.png?ver=241113"></div>
					</div>
                               <?php
								if ($row["nft_c2"] > 0 or $row["nft_c3"] > 0) { $more_pie_nft_x2 = " x2"; $rank_pie_value = $rank_pie_value * 2;} else {$more_pie_nft_x2 = "";}
								?>
					<div class="ranking_pie">
						<div class="txt<?=$more_pie_nft_x2?>"><?=$rank_pie_value?></div>
						<div class="img"><img src="<?=G5_APP_CDN_IMG?>/attend_pie.png"></div>
					</div>
				</li>
			</ul>
			<?php
            }
            ?>
	</div>

    
	</div>
</div>


	<?php include_once(G5_APP_PATH.'/include/footer.php'); // 하단 네비 ?>
	</div>
	
</div>

<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" class="iframe_pop" id="iframe_new_pop" style="display:none;"></iframe>
<iframe src="<?=G5_APP_URL?>/none.html" width="0" height="0" border="0" id="app_action_frame" style="display:none;"></iframe>
<!-- script 코드 전체 추가 -->
<script type="module">
	window.distribute = distribute;
	import { ethers } from "https://cdn.jsdelivr.net/npm/ethers@latest/+esm";

	let factoryContract;
	let wallet;
	const programAbi = [
		{
			"inputs": [
				{
					"internalType": "uint256",
					"name": "_programId",
					"type": "uint256"
				},
				{
					"internalType": "address",
					"name": "_owner",
					"type": "address"
				}
			],
			"stateMutability": "payable",
			"type": "constructor"
		},
		{
			"anonymous": false,
			"inputs": [
				{
					"indexed": true,
					"internalType": "address",
					"name": "from",
					"type": "address"
				},
				{
					"indexed": false,
					"internalType": "uint256",
					"name": "amount",
					"type": "uint256"
				}
			],
			"name": "FundsDeposited",
			"type": "event"
		},
		{
			"anonymous": false,
			"inputs": [
				{
					"indexed": true,
					"internalType": "address",
					"name": "to",
					"type": "address"
				},
				{
					"indexed": false,
					"internalType": "uint256",
					"name": "amount",
					"type": "uint256"
				}
			],
			"name": "FundsWithdrawn",
			"type": "event"
		},
		{
			"anonymous": false,
			"inputs": [
				{
					"indexed": true,
					"internalType": "uint256",
					"name": "rank",
					"type": "uint256"
				},
				{
					"indexed": false,
					"internalType": "uint256",
					"name": "reward",
					"type": "uint256"
				}
			],
			"name": "InvalidAddress",
			"type": "event"
		},
		{
			"anonymous": false,
			"inputs": [
				{
					"indexed": true,
					"internalType": "address",
					"name": "from",
					"type": "address"
				},
				{
					"indexed": true,
					"internalType": "address",
					"name": "to",
					"type": "address"
				},
				{
					"indexed": false,
					"internalType": "uint256",
					"name": "amount",
					"type": "uint256"
				}
			],
			"name": "Transfer",
			"type": "event"
		},
		{
			"inputs": [],
			"name": "deposit",
			"outputs": [],
			"stateMutability": "payable",
			"type": "function"
		},
		{
			"inputs": [
				{
					"components": [
						{
							"internalType": "uint256",
							"name": "rank",
							"type": "uint256"
						},
						{
							"internalType": "address",
							"name": "walletAddr",
							"type": "address"
						},
						{
							"internalType": "uint256",
							"name": "reward",
							"type": "uint256"
						}
					],
					"internalType": "struct ConutProgram.Ranking[]",
					"name": "rankings",
					"type": "tuple[]"
				}
			],
			"name": "distributeRewards",
			"outputs": [],
			"stateMutability": "nonpayable",
			"type": "function"
		},
		{
			"inputs": [],
			"name": "getBalance",
			"outputs": [
				{
					"internalType": "uint256",
					"name": "",
					"type": "uint256"
				}
			],
			"stateMutability": "view",
			"type": "function"
		},
		{
			"inputs": [],
			"name": "setStatus",
			"outputs": [],
			"stateMutability": "nonpayable",
			"type": "function"
		},
		{
			"inputs": [],
			"name": "totalFunds",
			"outputs": [
				{
					"internalType": "uint256",
					"name": "",
					"type": "uint256"
				}
			],
			"stateMutability": "view",
			"type": "function"
		},
		{
			"inputs": [],
			"name": "withdraw",
			"outputs": [],
			"stateMutability": "nonpayable",
			"type": "function"
		},
		{
			"stateMutability": "payable",
			"type": "receive"
		}
	];

	async function initContract() {
		// Provider 설정
		const provider = new ethers.JsonRpcProvider("https://rpc.open-campus-codex.gelato.digital");
		const privateKey = "Insert private key";
		wallet = new ethers.Wallet(privateKey, provider);

		const contractAddress = "0xd857d8665C047a35C2949d64c5c6Aa16946418f8";

		const factoryAbi = [
			{
				"inputs": [],
				"stateMutability": "nonpayable",
				"type": "constructor"
			},
			{
				"anonymous": false,
				"inputs": [
					{
						"indexed": false,
						"internalType": "address",
						"name": "programAddr",
						"type": "address"
					},
					{
						"indexed": false,
						"internalType": "uint256",
						"name": "programId",
						"type": "uint256"
					}
				],
				"name": "ProgramCreated",
				"type": "event"
			},
			{
				"inputs": [],
				"name": "createProgram",
				"outputs": [
					{
						"internalType": "address",
						"name": "",
						"type": "address"
					}
				],
				"stateMutability": "payable",
				"type": "function"
			},
			{
				"inputs": [],
				"name": "getPrograms",
				"outputs": [
					{
						"internalType": "address[]",
						"name": "",
						"type": "address[]"
					}
				],
				"stateMutability": "view",
				"type": "function"
			},
			{
				"inputs": [],
				"name": "lastEndTime",
				"outputs": [
					{
						"internalType": "uint256",
						"name": "",
						"type": "uint256"
					}
				],
				"stateMutability": "view",
				"type": "function"
			}
		];

		factoryContract = new ethers.Contract(contractAddress, factoryAbi, wallet);
	}

	window.onload = async () => {
		try {
			await initContract();
			console.log("NFT Contract Initialized");
		} catch (error) {
			console.error("Failed to initialize NFT contract", error);
		}
	};
	
	const data = {
		"rankings": [
	<?php
    $sql = " SELECT mb_id,mb_nick,mb_point,mb_homepage,nft_c2,nft_c3,wepin_wallet FROM 0_edu_coquiz_g5_member WHERE wepin_wallet != '' AND mb_level = 2 AND mb_point and mb_leave_date = '' ORDER BY mb_point DESC LIMIT 10";
    $result = sql_query($sql);
    $total_rank_v_json = 1;
	        
    for ($i_json = 0; $row = sql_fetch_array($result); $i_json++) { 
            
			$total_rank_v = $total_rank_v_json + $i_json;	
            
                if ($total_rank_v == 1) {
                    $rank_pie_value = 500000000000000;
                } else if ($total_rank_v == 2 ) {
                    $rank_pie_value = 300000000000000;
                } else if ($total_rank_v == 3 ) {
                    $rank_pie_value = 200000000000000;			
                } else if ($total_rank_v == 4 ) {
                    $rank_pie_value = 100000000000000;			
                } else if ($total_rank_v == 5 ) {
                    $rank_pie_value = 50000000000000;
                } else if ($total_rank_v == 6 ) {
                    $rank_pie_value = 40000000000000;
                } else if ($total_rank_v == 7 ) {
                    $rank_pie_value = 30000000000000;
                } else if ($total_rank_v == 8 ) {
                    $rank_pie_value = 20000000000000;
                } else if ($total_rank_v == 9 ) {
                    $rank_pie_value = 10000000000000;
                } else if ($total_rank_v == 10 ) {
                    $rank_pie_value = 5000000000000;
                }
				
			if ($row["nft_c2"] > 0 or $row["nft_c3"] > 0) {$rank_pie_value = $rank_pie_value * 2;}
	?>
	{ "rank": <?=$total_rank_v?>, "walletAddr": "<?=$row["wepin_wallet"]?>", "reward": <?=$rank_pie_value?> },
	<?php
	}
	?>
		]
	};
	

	async function distribute() {
		if(confirm("Should I pay out the prize money?")){
			
			if (!factoryContract) {
				console.error("Factory Contract is not initialized");
				return;
			}
			try {
				const programs = await factoryContract.getPrograms();
				const programAddress = programs[programs.length - 1];
				console.log(programAddress);
				const programContract = new ethers.Contract(programAddress, programAbi, wallet);
	
				const result = await programContract.distributeRewards(data.rankings);
				console.log("distribute 결과: ", result);
				swal_alert("Payment completed");
			} catch (error) {
				console.error("distribute 실패", error);
			}
			
		}else{
			
			return;
			
		}
	}
	
    window.createProgram = createProgram;
    async function createProgram() {
        if (!factoryContract) {
            console.error("Factory Contract is not initialized");
            return;
        }
        try {
            const response = await factoryContract.createProgram({value: 10000000000000000});
            const programs = await factoryContract.getPrograms();
            console.log("Program Id: ",programs[programs.length-1]);
        } catch (error) {
            console.error("createProgram 실패", error);
        }
    }
</script>
<script>
function full_frame_view(value) {
	document.getElementById("iframe_new_pop").src = value;
	document.getElementById("iframe_new_pop").style.display = "block";
}

function full_frame_close() {
	document.getElementById("iframe_new_pop").src = "<?=G5_APP_URL?>/none.html";
	document.getElementById("iframe_new_pop").style.display = "none";
}
	
</script>
<?php
include_once('tail.sub.php');
?>