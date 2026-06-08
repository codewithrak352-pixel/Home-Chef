<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once 'config/db.php';

$role = $_SESSION['user_role'];
$name = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];

// Fetch some quick stats for the dashboard
$totalOrders = 0;
$totalEarnings = 0;
$successRate = "98%"; // Mock stat for professional feel

if ($role === 'seller') {
    // For sellers, we check order_items where they are the seller
    $stmt = $pdo->prepare("SELECT COUNT(DISTINCT order_id) as count, SUM(price * quantity) as revenue FROM order_items WHERE seller_id = ?");
    $stmt->execute([$userId]);
    $stats = $stmt->fetch();
    $totalOrders = $stats['count'] ?? 0;
    $totalEarnings = $stats['revenue'] ?? 0;
} else {
    // For customers, we check the orders table
    $stmt = $pdo->prepare("SELECT COUNT(*) as count, SUM(total_amount) as spent FROM orders WHERE customer_id = ?");
    $stmt->execute([$userId]);
    $stats = $stmt->fetch();
    $totalOrders = $stats['count'] ?? 0;
    $totalEarnings = $stats['spent'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .dash-card { background: #fff; border-radius: 20px; padding: 30px; border: 1px solid var(--border-color); transition: var(--transition); height: 100%; }
    .dash-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
    .stat-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px; }
    .percentage-badge { background: var(--primary-light); color: var(--primary); padding: 5px 12px; border-radius: 50px; font-weight: 700; font-size: 0.8rem; }
    .chart-container { height: 250px; margin-top: 20px; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_dashboard.php'; ?>

<section class="py-5" style="background: var(--bg-cream);">
  <div class="container py-4" data-aos="fade-down">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
      <div>
        <h2 class="display-5 fw-bold">Welcome back, <span class="primary-text"><?php echo explode(' ', $name)[0]; ?>!</span></h2>
        <p class="text-muted">Here's your professional overview for this week.</p>
      </div>
      <div class="d-flex gap-3">
        <div class="text-center bg-white p-3 rounded-4 border shadow-sm">
          <div class="small text-muted text-uppercase fw-bold mb-1">Weekly Growth</div>
          <div class="h4 fw-bold text-success mb-0">+12.5% <i class="fas fa-arrow-up small"></i></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container py-5 mb-5">
  <div class="row g-4">
    <!-- Quick Stats Row -->
    <div class="col-md-4" data-aos="fade-up">
      <div class="dash-card">
        <div class="stat-icon bg-primary text-white"><i class="fas fa-shopping-bag"></i></div>
        <h6 class="text-muted text-uppercase small fw-bold">Total Orders</h6>
        <h2 class="fw-bold serif-font"><?php echo $totalOrders; ?></h2>
        <span class="percentage-badge">98% Success Rate</span>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
      <div class="dash-card">
        <div class="stat-icon bg-success text-white"><i class="fas fa-wallet"></i></div>
        <h6 class="text-muted text-uppercase small fw-bold"><?php echo ($role === 'seller') ? 'Total Revenue' : 'Total Spent'; ?></h6>
        <h2 class="fw-bold serif-font">Rs. <?php echo number_format($totalEarnings); ?></h2>
        <span class="percentage-badge">+Rs. 4,500 today</span>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
      <div class="dash-card">
        <div class="stat-icon bg-info text-white"><i class="fas fa-users"></i></div>
        <h6 class="text-muted text-uppercase small fw-bold">Profile Views</h6>
        <h2 class="fw-bold serif-font">1,240</h2>
        <span class="percentage-badge">Top 5% in <?php echo ($_SESSION['user_city'] ?? 'Lahore'); ?></span>
      </div>
    </div>

    <!-- Main Content Row -->
    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
      <div class="dash-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-bold serif-font">Performance Analytics</h4>
          <select class="form-select form-select-sm w-auto rounded-pill px-3">
            <option>Last 7 Days</option>
            <option>Last 30 Days</option>
          </select>
        </div>
        <div class="chart-container">
          <canvas id="performanceChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
      <div class="dash-card">
        <h4 class="fw-bold serif-font mb-4">Quick Actions</h4>
        <div class="d-grid gap-3">
          <?php if ($role === 'seller'): ?>
            <a href="newdish.php" class="btn btn-primary py-3 rounded-pill fw-bold"><i class="fas fa-plus me-2"></i> Add New Dish</a>
            <a href="manage-dishes.php" class="btn btn-outline-primary py-3 rounded-pill fw-bold">Manage Menu</a>
            <a href="earnings.php" class="btn btn-outline-primary py-3 rounded-pill fw-bold">View Reports</a>
          <?php else: ?>
            <a href="buyfood.php" class="btn btn-primary py-3 rounded-pill fw-bold"><i class="fas fa-utensils me-2"></i> Browse Menu</a>
            <a href="myorders.php" class="btn btn-outline-primary py-3 rounded-pill fw-bold">Track Orders</a>
            <a href="family.php" class="btn btn-outline-primary py-3 rounded-pill fw-bold">Family Plans</a>
          <?php endif; ?>
          <a href="profile.php" class="btn btn-light py-3 rounded-pill fw-bold">Account Settings</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  const ctx = document.getElementById('performanceChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Revenue Growth',
        data: [1200, 1900, 1500, 2500, 2200, 3000, 2800],
        borderColor: '#008a00',
        backgroundColor: 'rgba(0, 138, 0, 0.1)',
        fill: true,
        tension: 0.4,
        borderWidth: 3,
        pointBackgroundColor: '#008a00'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { display: false } },
        x: { grid: { display: false } }
      }
    }
  });
</script>
</body>
</html>
