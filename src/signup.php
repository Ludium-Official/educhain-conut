<?php
// wepin
$appId = 'fabc3e2b39b96fb214dbd3f027ed1726';
$appKey = 'ak_live_6LktE7yRpWCwjOWMmQuADeADltfEuGLJfnfNWrjdcoE';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tailwind PHP Website</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Wepin SDK -->
    <script type="module">
        // wepin
        import { WepinSDK } from 'https://cdn.jsdelivr.net/npm/@wepin/sdk-js@latest/+esm';

        document.addEventListener("DOMContentLoaded", async () => {
            const wepinSdk = new WepinSDK({
                appId: "<?php echo $appId; ?>",  // PHP에서 설정한 App ID
                appKey: "<?php echo $appKey; ?>" // PHP에서 설정한 App Key
            });

            // 위젯 초기화
            await wepinSdk.init({
                defaultLanguage: "ko",
            });

            // 버튼 이벤트 핸들링
            // document.getElementById("connect-widget").addEventListener("click", async () => {
            //     console.log("Wepin 위젯 초기화 완료");
            //     try{
            //         // await wepinSdk.logout();

            //         const response = await wepinSdk.loginWithUI();

            //         console.log(response);
                    
            //         if (response.status === "success") {
            //             console.log("로그인 성공")
            //             const loginButton = document.getElementById("connect-widget");
            //             loginButton.classList.remove("bg-blue-600", "hover:bg-blue-700");
            //             loginButton.classList.add("bg-green-600", "hover:bg-green-700");
            //         } else {
            //             console.warn("로그인 상태가 success가 아닙니다:", response);
            //         }
            //     }
            //     catch(error){
            //         console.error(error);
            //     }
            // });

            document.getElementById("register-email").addEventListener("click", async () => {
                const response = await wepinSdk.register();
                console.log(response);
            });

            document.getElementById("open-wallet").addEventListener("click", async () => {
                const response = await wepinSdk.openWidget();
                console.log(response);
            });

            document.getElementById("get-status").addEventListener("click", async () => {
                const response = await wepinSdk.getAccounts(
                //     {
                //     networks: ["Ethereum","evmOpenCampus-Testnet"], 
                //     withEoa: true
                // }
            );
                console.log(response);
            });

            document.getElementById("logout").addEventListener("click", async () => {
                const response = await wepinSdk.logout();
                console.log(response);
            });

            // document.getElementById("send").addEventListener("click", async () => {
            //     const response = await wepinSdk.send({
            //         account: {
            //             address: '0x7A20e281D60edfFd6E7388187A3bcF1451f1CA75',
            //             network: "evmOpenCampus-Testnet",
            //         },
            //         txData: {
            //             to: '0x49f44752140f1a32493EB905d0A6Ee82677eE373',
            //             amount: '0.00001',
            //         }
            //     });
            //     console.log(response);
            // });
        });

        ////////////////////////////////////
        /////////////contract///////////////
        ////////////////////////////////////
        


    </script>
</head>
<body class="bg-gray-100 text-gray-800 flex-col items-center justify-center h-screen">

    <!-- 회원가입 폼 -->
    <div class="container mx-auto max-w-md px-4 py-8">
        <h1 class="text-2xl font-bold text-center mb-6">Sign Up / Login</h1>
        <form id="signupForm" class="bg-white shadow-lg rounded-lg p-6">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200" 
                    placeholder="Enter your email"
                    required
                >
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200" 
                    placeholder="Enter your password"
                    required
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition"
            >
                Sign Up
            </button>
        </form>
    </div>

    <script type="module">
        // 1. 패키지 import
        import { WepinLogin } from 'https://cdn.jsdelivr.net/npm/@wepin/login-js@latest/+esm';

        document.addEventListener("DOMContentLoaded", async () => {
            const wepinLogin = new WepinLogin({
                appId: "<?php echo $appId; ?>",
                appKey: "<?php echo $appKey; ?>"
            });

            await wepinLogin.init({
                defaultLanguage: "en",
            });

            // 회원가입 요청 처리
            document.getElementById('signupForm').addEventListener('submit', async function (event) {
                event.preventDefault(); // 폼 기본 동작 방지

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                if (!email || !password) {
                    alert('Email and password are required.');
                    return;
                }

                try {
                    const response = await wepinLogin.signUpWithEmailAndPassword(email, password);
                    console.log(response);
                    alert(response);
                } catch (error) {
                    // console.error(error);
                    if (error.message === 'auth/email-verified') {
                        alert("Please verify your email.");
                    } else if (error.message === 'auth/existed-email') {
                        try {
                            const loginResponse = await wepinLogin.loginWithEmailAndPassword(email, password);
                            console.log("result: ", loginResponse);
                            const userInfo = await wepinLogin.loginWepin(loginResponse);
                            console.log("userInfo: ", userInfo);
                            const userStatus = userInfo.userStatus;
                            console.log("userStatus: ", userStatus);
                            if(userStatus.loginStatus === 'pinRequired'||userStatus.loginStatus === 'registerRequired') {
                                // wepin register
                                console.log("register complete!");
                            }
                            // 여기서 loginResponse 처리 로직을 추가할 수 있습니다.
                        } catch (error) {
                            console.error(error);
                            alert(error);
                        }
                    } else {
                        alert(error);
                    }
                }

            });
        });
    </script>

    <!-- 위젯 연결 버튼 -->
    <div class="flex gap-1 justify-center mx-auto px-4 py-8">
        <!-- <button 
            id="connect-widget" 
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            로그인
        </button> -->

        <button 
            id="register-email"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">        
            사용자 등록
        </button>

        <button 
            id="open-wallet"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        
            내 지갑 열기
        </button>

        <button 
            id="get-status"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        
            account 상태
        </button>

        <!-- <button 
            id="send"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        
            send
        </button> -->

        <button 
            id="logout"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        
            로그아웃
        </button>
    </div>
</body>
</html>