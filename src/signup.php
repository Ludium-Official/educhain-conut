<?php
// Node.js로 요청 보내기 (PHP 섹션)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 입력 데이터 수집
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Node.js API 서버 URL
    $nodeServerUrl = 'http://localhost:3005/register';

    // 이메일 또는 패스워드가 비어 있으면 에러 반환
    if (!$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
        exit;
    }

    // Node.js로 전송할 데이터
    $data = [
        'email' => $email,
        'password' => $password
    ];

    // HTTP 요청 옵션 설정
    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    // Node.js API 서버로 요청 보내기
    $context = stream_context_create($options);
    $response = file_get_contents($nodeServerUrl, false, $context);

    if ($response === FALSE) {
        echo json_encode(['success' => false, 'message' => 'Failed to communicate with Node.js server.']);
        exit;
    }

    // Node.js 서버에서 받은 응답 출력
    echo $response;
    exit; // PHP 종료
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- 회원가입 폼 -->
    <div class="container mx-auto max-w-md px-4 py-8">
        <h1 class="text-2xl font-bold text-center mb-6">Sign Up</h1>
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

    <script>
        // 회원가입 요청 처리 (JavaScript 섹션)
        document.getElementById('signupForm').addEventListener('submit', async function (event) {
            event.preventDefault(); // 폼 기본 동작 방지

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Email and password are required.');
                return;
            }

            try {
                console.log(email, " || ", password);
                // PHP로 데이터를 전송
                const response = await fetch('signup.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ email, password })
                });

                console.log("A");
                const result = await response.json();
                console.log(response);

                if (result.success) {
                    alert(result.message); // 성공 메시지
                } else {
                    alert(result.message); // 실패 메시지
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during registration.');
            }
        });
    </script>

</body>
</html>
