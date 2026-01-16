<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Showroom Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: white;
            color: #000;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .sun-icon {
            width: 60px;
            height: 60px;
            display: block;
            margin: 0 auto 24px;
            object-fit: contain;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            background: transparent;
        }

        .form-control:focus {
            outline: none;
            border-bottom-color: #007AFF;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 0;
            top: 10px;
            cursor: pointer;
            color: #666;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0 25px;
        }

        .forgot-password {
            color: #007AFF;
            text-decoration: none;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: #000;
            color: white;
        }

        .btn-primary:hover {
            background: #333;
        }
    </style>
</head>

<body>
<div class="login-container">

    <img src="asset/sun-icon.png" alt="Sun icon" class="sun-icon">

    <h1>Welcome Again!</h1>
    <p class="subtitle">Please enter your details!</p>

    <!-- FORM -->
    <form method="post" action="login_proses.php" id="login-form">

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-container">
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                >
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
            </div>
        </div>

        <div class="remember-forgot">
            <label><input type="checkbox"> Remember for 30 days</label>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>

<script>
    // Toggle show/hide password
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        this.classList.toggle('fa-eye-slash');
    });

    // Simple animation
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.login-container');
        container.style.opacity = '0';
        container.style.transform = 'translateY(20px)';

        setTimeout(() => {
            container.style.transition = '0.5s';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);
    });
</script>

</body>
</html>
