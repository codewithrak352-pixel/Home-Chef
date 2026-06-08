<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullName'];
        $_SESSION['user_role'] = $user['role'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/login_bg.png') center/cover no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: #fff;
      padding: 50px;
      border-radius: 24px;
      box-shadow: var(--shadow-lg);
      width: 100%;
      max-width: 450px;
    }
    .login-header {
      text-align: center;
      margin-bottom: 40px;
    }
    .login-header h2 {
      font-size: 2.2rem;
      font-weight: 800;
      color: var(--primary);
      font-family: var(--font-serif);
    }
    .form-control {
      padding: 15px 20px;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      margin-bottom: 20px;
    }
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px var(--primary-light);
    }
    .btn-login {
      padding: 15px;
      font-weight: 700;
      font-size: 1.1rem;
      border-radius: 12px;
      width: 100%;
    }
    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 30px 0;
      color: #aaa;
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid var(--border-color);
    }
    .divider::before { margin-right: .75em; }
    .divider::after { margin-left: .75em; }
    
    .social-login {
      display: flex;
      gap: 15px;
    }
    .btn-social {
      flex: 1;
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-weight: 600;
      transition: var(--transition);
    }
    .btn-social:hover {
      background: #f8f9fa;
      border-color: #ddd;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="login-header">
    <a href="homechef.php" class="text-decoration-none">
      <h2>Home Chef</h2>
    </a>
    <p class="text-muted">Welcome back! Please login to your account.</p>
  </div>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger rounded-4"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label fw-bold small text-uppercase">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
    </div>
    <div class="mb-3">
      <div class="d-flex justify-content-between">
        <label class="form-label fw-bold small text-uppercase">Password</label>
        <a href="#" class="small text-primary text-decoration-none fw-bold">Forgot?</a>
      </div>
      <input type="password" name="password" class="form-control" placeholder="••••••••" required>
    </div>
    <div class="mb-4 form-check">
      <input type="checkbox" class="form-check-input" id="rememberMe">
      <label class="form-check-label small text-muted" for="rememberMe">Remember me for 30 days</label>
    </div>
    <button type="submit" class="btn btn-primary btn-login">Log In</button>
  </form>

  <div class="divider">or continue with</div>

  <div class="social-login">
    <button class="btn-social"><img src="https://www.google.com/favicon.ico" width="18"> Google</button>
    <button class="btn-social"><i class="fab fa-apple"></i> Apple</button>
  </div>

  <div class="text-center mt-5">
    <span class="text-muted">Don't have an account?</span>
    <a href="register.php" class="text-primary fw-bold text-decoration-none ms-1">Sign Up</a>
  </div>
</div>

</body>
</html>
