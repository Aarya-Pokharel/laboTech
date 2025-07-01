<?php
session_start();
require_once 'includes/category-mapping.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TourMate</title>
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
                    Join TourMate as a Tourist
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Register to hire a local guide or discover famous and unrevealed places and food experiences.
                </p>
            </div>

            
            <div class="bg-white rounded-lg shadow-md p-6">
                <form id="tourist-form" class="space-y-4" action="actions/register" method="POST">
                    <input type="hidden" name="user_type" value="tourist">
                    
                    <div class="form-group">
                        <label for="tourist_name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="tourist_name" required class="form-input" placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="tourist_email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="tourist_email" required class="form-input" placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label for="tourist_phone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" id="tourist_phone" required class="form-input" placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="tourist_location" class="form-label">Location</label>
                        <input type="text" name="location" id="tourist_location" required class="form-input" placeholder="Enter your location">
                    </div>

                    <div class="form-group">
                        <label for="tourist_password" class="form-label">Password</label>
                        <input type="password" name="password" id="tourist_password" required class="form-input" placeholder="Create a password">
                    </div>

                    <div class="form-group">
                        <label for="tourist_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="tourist_confirm_password" required class="form-input" placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-semibold">
                        Register as Tourist
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Want to become a local guide and share your city, food, and hidden places?
                    <a href="register_guide.php" class="font-semibold text-yellow-600 hover:text-yellow-500">
                        Register as Guide
                    </a>
                </p>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="login" class="font-semibold text-yellow-600 hover:text-yellow-500">
                        Sign in here
                    </a>
                </p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .user-type-btn {
            @apply flex flex-col items-center justify-center p-4 rounded-lg border-2 border-transparent transition-all duration-200;
        }
        
        .user-type-btn.active {
            @apply border-blue-600;
        }
        
        .user-type-btn:not(.active):hover {
            @apply bg-gray-100;
        }
    </style>

    <script>
      
        const categoryMapping = {
            'Unskilled Labor': ['Cleaning', 'Moving', 'Gardening', 'Driving', 'Security'],
            'Skilled Labor': ['Plumbing', 'Electrical', 'Carpentry', 'Painting', 'Repair', 'Installation', 'Cooking'],
            'Technical': ['IT Support', 'Web Development', 'Graphic Design'],
            'Professional': ['Consulting', 'Legal Services', 'Medical Services', 'Teaching']
        };

        function updateJobCategories() {
            const employeeCategory = document.getElementById('employee_category').value;
            const jobCategoriesDisplay = document.getElementById('job_categories_display');
            
            if (employeeCategory && categoryMapping[employeeCategory]) {
                const jobCategories = categoryMapping[employeeCategory];
                const categoryList = jobCategories.map(cat => `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-2 mb-1">${cat}</span>`).join('');
                
                jobCategoriesDisplay.innerHTML = `
                    <p class="text-sm font-medium text-gray-700 mb-2">You can work on these job types:</p>
                    <div class="flex flex-wrap">
                        ${categoryList}
                    </div>
                    <p class="text-xs text-gray-500 mt-2">These jobs will automatically appear in your available jobs list</p>
                `;
            } else {
                jobCategoriesDisplay.innerHTML = '<p class="text-sm text-gray-500">Select your professional category above to see available job types</p>';
            }
        }

        function selectUserType(type) {
            const customerBtn = document.getElementById('customer-btn');
            const employeeBtn = document.getElementById('employee-btn');
            const customerForm = document.getElementById('customer-form');
            const employeeForm = document.getElementById('employee-form');

            if (type === 'customer') {
                customerBtn.classList.add('active', 'bg-blue-600', 'text-white');
                customerBtn.classList.remove('bg-gray-200', 'text-gray-700');
                employeeBtn.classList.remove('active', 'bg-blue-600', 'text-white');
                employeeBtn.classList.add('bg-gray-200', 'text-gray-700');
                customerForm.classList.remove('hidden');
                employeeForm.classList.add('hidden');
            } else {
                employeeBtn.classList.add('active', 'bg-blue-600', 'text-white');
                employeeBtn.classList.remove('bg-gray-200', 'text-gray-700');
                customerBtn.classList.remove('active', 'bg-blue-600', 'text-white');
                customerBtn.classList.add('bg-gray-200', 'text-gray-700');
                employeeForm.classList.remove('hidden');
                customerForm.classList.add('hidden');
            }
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const password = form.querySelector('input[name="password"]');
                    const confirmPassword = form.querySelector('input[name="confirm_password"]');
                    
                    if (password.value !== confirmPassword.value) {
                        e.preventDefault();
                        alert('Passwords do not match!');
                        return false;
                    }
                    
                    if (password.value.length < 6) {
                        e.preventDefault();
                        alert('Password must be at least 6 characters long!');
                        return false;
                    }
                });
            });
        });
    </script>
</body>
</html> 