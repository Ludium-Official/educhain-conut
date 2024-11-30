<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tailwind PHP Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">My Website</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#" class="hover:underline">About</a></li>
                    <li><a href="#" class="hover:underline">Services</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="bg-cover bg-center h-64 text-center text-white" style="background-image: url('https://via.placeholder.com/1200x400');">
        <div class="bg-black bg-opacity-50 h-full flex items-center justify-center">
            <div>
                <h2 class="text-4xl font-bold">Welcome to My Website</h2>
                <p class="mt-2 text-lg">Your gateway to awesome content</p>
                <!-- 현재 날짜와 시간 표시 -->
                <p class="mt-4 text-sm">
                    <?php
                        date_default_timezone_set('Asia/Seoul'); // 타임존 설정
                        echo "Today is " . date("Y-m-d") . " | Current Time: " . date("H:i:s");
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <main class="container mx-auto px-4 py-8">
        <h3 class="text-2xl font-bold mb-4">About Us</h3>
        <p class="mb-4">
            Welcome to our website! We are dedicated to providing you with the best experience possible.
            Explore our services, learn about our mission, and get in touch with us if you have any questions.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-2">Service 1</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id tortor quis libero suscipit fermentum.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-2">Service 2</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id tortor quis libero suscipit fermentum.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-xl font-semibold mb-2">Service 3</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id tortor quis libero suscipit fermentum.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date('Y'); ?> My Website. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
