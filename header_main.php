<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<header id="mainHeader">
  <div class="container d-flex justify-content-between align-items-center">
    <h1><a href="homechef.php" class="text-primary text-decoration-none">Home Chef</a></h1>
    <nav class="d-none d-md-flex align-items-center gap-4">
      <a href="buyfood.php">Our Menu</a>
      <a href="family.php">Family Plan</a>
      <a href="hirechef.php">Hire a Chef</a>
      <a href="newdish.php">Become a Chef</a>
      <a href="gift-cards.php">Gift Cards</a>
      <?php if ($isLoggedIn): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="nav-icon-highlight">Logout</a>
      <?php else: ?>
        <a href="login.php">Log In</a>
        <a href="register.php" class="nav-icon-highlight">Get Started</a>
      <?php endif; ?>
    </nav>
    <button class="btn d-md-none text-primary fs-3" id="mobileMenuToggle">
      <i class="fas fa-bars"></i>
    </button>
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
