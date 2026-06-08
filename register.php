<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $role = $_POST['role'] ?? 'customer';
    $phone = $_POST['phone'] ?? '';
    $city = $_POST['city'] ?? '';

    try {
        $stmt = $pdo->prepare("INSERT INTO users (fullName, email, password, role, phone, city) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fullName, $email, $password, $role, $phone, $city]);
        header('Location: login.php?registered=1');
        exit;
    } catch (\PDOException $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body {
      background: var(--bg-cream);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }
    .register-card {
      background: #fff;
      padding: 50px;
      border-radius: 24px;
      box-shadow: var(--shadow-lg);
      width: 100%;
      max-width: 600px;
    }
    .register-header {
      text-align: center;
      margin-bottom: 40px;
    }
    .register-header h2 {
      font-size: 2.2rem;
      font-weight: 800;
      color: var(--primary);
      font-family: var(--font-serif);
    }
    .form-control, .form-select {
      padding: 12px 18px;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      margin-bottom: 15px;
    }
    .btn-register {
      padding: 15px;
      font-weight: 700;
      font-size: 1.1rem;
      border-radius: 12px;
      width: 100%;
      margin-top: 20px;
    }
    .step-indicator {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 30px;
    }
    .step-dot {
      width: 40px; height: 6px;
      background: #eee;
      border-radius: 3px;
    }
    .step-dot.active {
      background: var(--primary);
    }
  </style>
</head>
<body>

<div class="register-card">
  <div class="register-header">
    <a href="homechef.php" class="text-decoration-none">
      <h2>Home Chef</h2>
    </a>
    <p class="text-muted">Start your culinary journey with us today.</p>
  </div>

  <div class="step-indicator">
    <div class="step-dot active"></div>
    <div class="step-dot"></div>
    <div class="step-dot"></div>
  </div>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger rounded-4"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">Full Name</label>
        <input type="text" name="fullName" class="form-control" placeholder="John Doe" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">Password</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="03xx-xxxxxxx" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">City</label>
        <input type="text" name="city" class="form-control" placeholder="Lahore, Karachi, etc." required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label fw-bold small text-uppercase">I am a...</label>
        <select name="role" class="form-select">
          <option value="customer">Customer (I want to eat)</option>
          <option value="seller">Home Chef (I want to cook)</option>
        </select>
      </div>
    </div>

    <div class="form-check mb-4">
      <input class="form-check-input" type="checkbox" id="terms" required>
      <label class="form-check-label small text-muted" for="terms">
        I agree to the Home Chef <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>.
      </label>
    </div>

    <button type="submit" class="btn btn-primary btn-register">Create My Account</button>
  </form>

  <div class="text-center mt-4">
    <span class="text-muted">Already have an account?</span>
    <a href="login.php" class="text-primary fw-bold text-decoration-none ms-1">Log In</a>
  </div>
</div>

</body>
</html>
