<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<header id="mainHeader" class="sticky-top bg-white shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <h1><a href="homechef.php" class="text-primary text-decoration-none">Home Chef</a></h1>
    <nav class="d-none d-md-flex align-items-center gap-4">
      <a href="homechef.php">Home</a>
      <a href="buyfood.php">Our Menu</a>
      <a href="dashboard.php">Dashboard</a>
      <div class="dropdown">
        <button class="btn btn-primary rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['user_name']; ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow-lg border-0 mt-2">
          <li><a class="dropdown-item py-2" href="profile.php"><i class="fas fa-user me-2 opacity-50"></i> Profile</a></li>
          <li><a class="dropdown-item py-2" href="myorders.php"><i class="fas fa-box me-2 opacity-50"></i> My Orders</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item py-2 text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2 opacity-50"></i> Logout</a></li>
        </ul>
      </div>
    </nav>
  </div>
</header>

<script>
  (function() {
    <?php if (isset($_SESSION['user_id'])): ?>
      localStorage.setItem('currentUser', JSON.stringify({
        id: <?php echo json_encode($_SESSION['user_id']); ?>,
        fullName: <?php echo json_encode($_SESSION['user_name']); ?>,
        role: <?php echo json_encode($_SESSION['user_role']); ?>,
        loggedIn: true
      }));
    <?php else: ?>
      localStorage.removeItem('currentUser');
    <?php endif; ?>
  })();
</script>
