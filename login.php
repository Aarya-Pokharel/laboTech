<?php
require_once 'includes/session.php';
if(isset($_SESSION['guide'])){
  header('location: manager/index.php');
  exit();
}else if(isset($_SESSION['tourist'])){
  header('location: tourist/index.php');
  exit();
}
?>
<html>
<head>
  <title>Login | TourMate</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/webp" href="assets/logo.png">
</head>
<body>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-gradient-to-br from-blue-50 to-yellow-50 min-h-screen">
    <div class="absolute top-4 left-4">
      <a href="index.html" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Return to Home
      </a>
    </div>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <a href="index.html">
        <img class="mx-auto h-20 w-auto cursor-pointer" src="assets/logo.png" alt="TourMate Logo" style="height: 100px;">
      </a>
      <h2 class="mt-10 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to TourMate</h2>
      <p class="mt-2 text-center text-sm text-gray-600">For Tourists & Guides</p>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="actions/login.php" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-yellow-500 focus:ring-yellow-500">
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-yellow-500 focus:ring-yellow-500">
          </div>
        </div>
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-2 text-base font-semibold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-500 transition">Sign in</button>
        </div>
      </form>
      <p class="mt-6 text-center text-sm text-red-600">
        <?php
        if(isset($_SESSION['error'])){
          echo $_SESSION['error'] ;
        unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo $_SESSION['success'] ;
        unset($_SESSION['success']);
        }
        ?>
      </p>
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Don't have an account?
          <a href="register.php" class="font-semibold text-yellow-600 hover:text-yellow-500">Sign up here</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html> 