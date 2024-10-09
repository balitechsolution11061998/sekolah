<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap 5 CSS for button styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
        }

        #progressBar {
            display: none;
            height: 5px;
            background-color: #3490dc;
        }

        .toastify {
            border-radius: 0.375rem !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.875rem;
        }

        .toastify-icon {
            font-size: 1.25rem;
            margin-right: 8px;
        }

    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-sm mx-auto animate__animated animate__fadeInUp">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div id="progressBar"></div>

            <div class="text-center mb-6">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="w-20 mx-auto">
            </div>

            <h3 class="text-2xl font-semibold text-center mb-4">Welcome Back</h3>
            <p class="text-center text-gray-500 mb-6">Please login to your account</p>

            <form id="loginForm" method="POST" action="{{ route('login.prosesForm') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg" placeholder="Enter your password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember Me</label>
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>
                <p class="text-center text-gray-500 mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a></p>

            </form>
        </div>
    </div>

    <!-- Toastify and JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const progressBar = document.getElementById('progressBar');
        const loginForm = document.getElementById('loginForm');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Handle form submission with SweetAlert confirmation and AJAX
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to submit your login details.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, login!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show progress bar
                    progressBar.style.display = 'block';
                    progressBar.style.width = '0%';

                    let width = 0;
                    const interval = setInterval(() => {
                        if (width >= 100) {
                            clearInterval(interval);
                        } else {
                            width += 10;
                            progressBar.style.width = width + '%';
                        }
                    }, 200);

                    // Submit form via AJAX
                    axios.post(loginForm.action, new FormData(loginForm))
                        .then(function (response) {
                            console.log(response);
                            // Show success notification
                            Toastify({
                                text: "Login successful!",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "green",
                                stopOnFocus: true,
                                avatar: '<i class="fas fa-check-circle text-white toastify-icon"></i>',
                            }).showToast();

                            setTimeout(() => {
                                window.location.href = response.data.redirect; // Redirect on success
                            }, 3000);
                        })
                        .catch(function (error) {
                            // Show error notification
                            Toastify({
                                text: "Login failed! Please check your credentials.",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "red",
                                stopOnFocus: true,
                                avatar: '<i class="fas fa-times-circle text-white toastify-icon"></i>',
                            }).showToast();

                            // Hide progress bar
                            progressBar.style.display = 'none';
                        });
                }
            });
        });
    </script>
</body>
</html>
