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
  <title>Register | TourMate</title>
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
      <h2 class="mt-10 text-center text-3xl font-bold tracking-tight text-gray-900">Sign up for TourMate</h2>
      <p class="mt-2 text-center text-sm text-gray-600">For Tourists & Guides</p>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="actions/register.php" method="POST">
        <div class="flex justify-center gap-4 mb-4">
          <button type="button" id="tourist-btn" class="user-type-btn active" onclick="selectUserType('tourist')">Tourist</button>
          <button type="button" id="guide-btn" class="user-type-btn" onclick="selectUserType('guide')">Guide</button>
        </div>
        <input type="hidden" name="user_type" id="user_type" value="tourist">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
          <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
          <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
          <input type="text" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
          <input type="text" id="location" name="location" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div id="bio-field" style="display:none;">
          <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Guide Bio</label>
          <textarea id="bio" name="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tell tourists about your expertise, places you know, and languages you speak"></textarea>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
          <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
          <input type="password" id="confirm_password" name="confirm_password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Register</button>
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
          Already have an account?
          <a href="login.php" class="font-semibold text-yellow-600 hover:text-yellow-500">Sign in here</a>
        </p>
      </div>
    </div>
  </div>
  <style>
    .user-type-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      border-radius: 0.5rem;
      border: 2px solid transparent;
      transition: all 0.2s;
    }
    .user-type-btn.active {
      border-color: #2563eb;
    }
    .user-type-btn:not(.active):hover {
      background-color: #f3f4f6;
    }
  </style>
  <script>
    function selectUserType(type) {
      document.getElementById('user_type').value = type;
      if (type === 'guide') {
        document.getElementById('bio-field').style.display = 'block';
        document.getElementById('guide-btn').classList.add('active');
        document.getElementById('tourist-btn').classList.remove('active');
      } else {
        document.getElementById('bio-field').style.display = 'none';
        document.getElementById('tourist-btn').classList.add('active');
        document.getElementById('guide-btn').classList.remove('active');
      }
    }
  </script>
</body>
</html> 