<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--bs-body-bg);
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            max-width: 600px;
            width: 90%;
            margin: 20px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            background-color: var(--bs-body-bg);
            transition: all 0.3s ease-in-out;
        }

        h3 {
            color: var(--bs-body-color);
            margin-bottom: 20px;
        }

        .form-label-custom {
            font-weight: bold;
            color: var(--bs-body-color);
        }

        .input-group {
            border-radius: 8px;
            overflow: hidden;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .progress {
            height: 10px;
            border-radius: 8px;
            overflow: hidden;
        }

        .progress-bar {
            transition: width 0.3s;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 12px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 12px;
        }

        .spinner-border {
            display: none;
            width: 1.25rem;
            height: 1.25rem;
            border-width: 0.2rem;
        }

        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-loading .spinner-border {
            display: inline-block;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            display: block;
            transition: transform 0.3s;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .theme-toggle {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5" style="width:500px;">
        <div class="card shadow-lg rounded">
            <div class="card-body p-4">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="logo mx-auto d-block mb-4" style="width: 80px;">
                <h3 class="text-center mb-4">Register</h3>

                <form method="POST" action="{{ route('register') }}" id="registrationForm">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autofocus>
                            @error('username')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required onkeyup="checkPasswordStrength()">
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="progress mt-2">
                            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fas fa-user-tag"></i>
                            </span>
                            <select id="role" class="form-select @error('role') is-invalid @enderror" name="role"
                                required>
                                <option value="" disabled selected>Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span>Register</span>
                        </button>
                    </div>
                </form>
                <button class="btn btn-secondary mt-3 w-100 theme-toggle" id="toggleTheme">Toggle Light/Dark Mode</button>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>

    <script>
        // Dark mode toggle functionality
        const themeToggleBtn = document.getElementById('toggleTheme');
        themeToggleBtn.addEventListener('click', function() {
            const htmlElement = document.documentElement;
            if (htmlElement.getAttribute('data-bs-theme') === 'light') {
                htmlElement.setAttribute('data-bs-theme', 'dark');
            } else {
                htmlElement.setAttribute('data-bs-theme', 'light');
            }
        });

        // Password Strength Checker
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('password-strength-bar');
            let strength = 0;

            if (password.length >= 8) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            if (/[@$!%*?&#]/.test(password)) strength += 25;

            strengthBar.style.width = strength + '%';

            if (strength <= 50) {
                strengthBar.className = 'progress-bar bg-danger';
            } else if (strength <= 75) {
                strengthBar.className = 'progress-bar bg-warning';
            } else {
                strengthBar.className = 'progress-bar bg-success';
            }
        }

        $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                const $submitBtn = $(this).find('button[type="submit"]');
                const $spinner = $submitBtn.find('.spinner-border');
                const $progressBar = $('#progressBar');
                const $progressContainer = $('.progress');

                // Show loading spinner and progress bar
                $spinner.show();
                $submitBtn.addClass('btn-loading').prop('disabled', true);
                $progressContainer.show();
                $progressBar.css('width', '0%');

                // Send the request with form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $spinner.hide();
                        $progressContainer.hide();
                        $submitBtn.removeClass('btn-loading').prop('disabled', false);
                        console.log(response,'response');
                        if (response.status === 200) {
                            if (response.data_exists) {
                                // User already exists
                                Toastify({
                                    text: 'User     already exists!',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: '#dc3545', // Red for error
                                    icon: 'fas fa-times-circle',
                                    className: 'toast-error'
                                }).showToast();
                            } else {
                                // Registration successful
                                Toastify({
                                    text: 'Registration successful!',
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: '#28a745', // Green for success
                                    icon: 'fas fa-check-circle',
                                    className: 'toast-success'
                                }).showToast();

                                // Redirect to login page after 3 seconds
                                setTimeout(function() {
                                    window.location.href = '/login';
                                }, 3000);
                            }
                        } else {
                            // Handle different status codes or general error
                            const errorMessage = response.message ? response.message :
                                'Something went wrong!';

                            // Show error message using Toastify
                            if (response.error === 'Validation error') {
                                Toastify({
                                    text: response.message,
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: '#dc3545', // Red for error
                                    icon: 'fas fa-times-circle',
                                    className: 'toast-error'
                                }).showToast();
                            } else {
                                Toastify({
                                    text: errorMessage,
                                    duration: 3000,
                                    gravity: 'top',
                                    position: 'right',
                                    backgroundColor: '#dc3545', // Red for error
                                    icon: 'fas fa-times-circle',
                                    className: 'toast-error'
                                }).showToast();
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        $spinner.hide();
                        $progressContainer.hide();
                        $submitBtn.removeClass('btn-loading').prop('disabled', false);

                        // Handle different status codes or general error
                        const errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Something went wrong!';

                        // Show error message using Toastify
                        if (xhr.responseJSON && xhr.responseJSON.error === 'Validation error') {
                            Toastify({
                                text: xhr.responseJSON.message,
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: '#dc3545', // Red for error
                                icon: 'fas fa-times-circle',
                                className: 'toast-error'
                            }).showToast();
                        } else {
                            Toastify({
                                text: errorMessage,
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: '#dc3545', // Red for error
                                icon: 'fas fa-times-circle',
                                className: 'toast-error'
                            }).showToast();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
