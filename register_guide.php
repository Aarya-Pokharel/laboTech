<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Guide | TourMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/webp" href="assets/logo.png">
    <link rel="stylesheet" href="main.css">
</head>
<body class="bg-gray-50">
    <div class="absolute top-4 left-4">
      <a href="index.html" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Return to Home
      </a>
    </div>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="index.html">
                    <img class="mx-auto h-16 w-auto cursor-pointer" src="assets/logo.png" alt="TourMate">
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Register as a Local Guide
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Share your city, food, and hidden places with travelers from around the world.
                </p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <form id="guide-form" class="space-y-4" action="actions/register" method="POST">
                    <input type="hidden" name="user_type" value="guide">
                    <div class="form-group">
                        <label for="guide_name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="guide_name" required class="form-input" placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="guide_email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="guide_email" required class="form-input" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="guide_phone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" id="guide_phone" required class="form-input" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="guide_location" class="form-label">Location</label>
                        <input type="text" name="location" id="guide_location" required class="form-input" placeholder="Enter your location">
                    </div>
                    <div class="form-group">
                        <label for="guide_bio" class="form-label">Short Bio / Description</label>
                        <textarea name="bio" id="guide_bio" rows="3" class="form-input" placeholder="Tell tourists about your experience, favorite places, or special skills..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="guide_password" class="form-label">Password</label>
                        <input type="password" name="password" id="guide_password" required class="form-input" placeholder="Create a password">
                    </div>
                    <div class="form-group">
                        <label for="guide_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="guide_confirm_password" required class="form-input" placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-semibold">
                        Register as Guide
                    </button>
                </form>
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Want to register as a tourist instead?
                        <a href="register.php" class="font-semibold text-yellow-600 hover:text-yellow-500">
                            Register as Tourist
                        </a>
                    </p>
                </div>
            </div>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="login" class="font-semibold text-yellow-600 hover:text-yellow-500">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html> 