<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once 'config/db.php';

$userId = $_SESSION['user_id'];

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    
    $stmt = $pdo->prepare("UPDATE users SET fullName = ?, phone = ?, city = ? WHERE id = ?");
    if ($stmt->execute([$fullName, $phone, $city, $userId])) {
        $_SESSION['user_name'] = $fullName;
        $success = "Profile updated successfully!";
        // Refresh user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .profile-card { background: #fff; border-radius: 30px; padding: 50px; border: 1px solid var(--border-color); box-shadow: var(--shadow-lg); max-width: 800px; margin: auto; }
    .profile-avatar { width: 120px; height: 120px; border-radius: 50%; border: 4px solid var(--primary-light); margin-bottom: 25px; object-fit: cover; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_dashboard.php'; ?>

<section class="py-5" style="background: var(--bg-cream);">
  <div class="container text-center py-5" data-aos="fade-down">
    <img src="https://images.unsplash.com/photo-1583394060263-f309526bcfef?w=200&auto=format" class="profile-avatar shadow-lg">
    <h2 class="display-5 fw-bold"><?php echo $user['fullName']; ?></h2>
    <p class="text-muted text-uppercase fw-bold small"><?php echo $user['role']; ?> Account</p>
  </div>
</section>

<div class="container py-5 mb-5">
  <div class="profile-card" data-aos="fade-up">
    <?php if (isset($success)): ?>
      <div class="alert alert-success rounded-4 mb-4"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form method="POST">
      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label fw-bold small text-uppercase">Full Name</label>
          <input type="text" name="fullName" class="form-control form-control-lg rounded-pill px-4" value="<?php echo $user['fullName']; ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold small text-uppercase">Email Address</label>
          <input type="email" class="form-control form-control-lg rounded-pill px-4 bg-light" value="<?php echo $user['email']; ?>" readonly>
          <small class="text-muted ms-3">Email cannot be changed</small>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold small text-uppercase">Phone Number</label>
          <input type="text" name="phone" class="form-control form-control-lg rounded-pill px-4" value="<?php echo $user['phone']; ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold small text-uppercase">City</label>
          <input type="text" name="city" class="form-control form-control-lg rounded-pill px-4" value="<?php echo $user['city']; ?>" required>
        </div>
        <div class="col-12 mt-5 text-center">
          <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold fs-5 shadow-lg">Save Profile Changes</button>
        </div>
      </div>
    </form>
    
    <hr class="my-5">
    
    <div class="text-center">
      <h5 class="fw-bold mb-3">Security</h5>
      <p class="text-muted small">Update your password or manage linked social accounts.</p>
      <button class="btn btn-outline-secondary rounded-pill px-4">Change Password</button>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

</body>
</html>
