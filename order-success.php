<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once 'config/db.php';

$role = $_SESSION['user_role'];
$name = $_SESSION['user_name'];
$orderId = $_GET['orderId'] ?? 'N/A';
$total = $_GET['total'] ?? '0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Successful | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-cream); height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .success-container { background: #fff; padding: 60px; border-radius: 40px; box-shadow: var(--shadow-lg); text-align: center; max-width: 800px; width: 90%; }
    .success-icon { font-size: 5rem; color: var(--primary); margin-bottom: 20px; animation: bounceIn 1s ease; }
    @keyframes bounceIn {
      0% { transform: scale(0.3); opacity: 0; }
      50% { transform: scale(1.05); opacity: 1; }
      70% { transform: scale(0.9); }
      100% { transform: scale(1); }
    }
    .stats-summary { background: var(--bg-soft); border-radius: 24px; padding: 30px; margin-top: 40px; text-align: left; }
    .stat-mini-chart { height: 100px; }
    .progress-track { display: flex; justify-content: space-between; position: relative; margin-bottom: 30px; }
    .progress-track::before { content: ''; position: absolute; top: 15px; left: 0; width: 100%; height: 4px; background: #eee; z-index: 1; }
    .progress-step { width: 35px; height: 35px; border-radius: 50%; background: #eee; z-index: 2; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #999; }
    .progress-step.active { background: var(--primary); color: #fff; box-shadow: 0 0 15px var(--primary-light); }
    .progress-step.completed { background: var(--primary); color: #fff; }
    .progress-label { position: absolute; top: 40px; font-size: 0.7rem; font-weight: 700; width: 80px; text-align: center; left: 50%; transform: translateX(-50%); }
    .step-container { position: relative; flex: 1; display: flex; flex-direction: column; align-items: center; }
    .progress-fill { position: absolute; top: 15px; left: 0; width: 33%; height: 4px; background: var(--primary); z-index: 1; }
  </style>
</head>
<body>

<div class="success-container" data-aos="zoom-in">
  <img src="assets/success.png" class="w-100 rounded-5 mb-4 shadow-lg" style="max-height: 250px; object-fit: cover;">
  <div class="success-icon"><i class="fas fa-check-circle"></i></div>
  <h1 class="serif-font fw-bold display-4 mb-2">Order Confirmed!</h1>
  <p class="fs-5 text-muted mb-4">Your meal is being prepared with fresh ingredients.</p>

  <div class="progress-track mb-5">
    <div class="progress-fill"></div>
    <div class="step-container">
      <div class="progress-step completed"><i class="fas fa-check"></i></div>
      <div class="progress-label">Confirmed</div>
    </div>
    <div class="step-container">
      <div class="progress-step active"><i class="fas fa-utensils"></i></div>
      <div class="progress-label">Preparing</div>
    </div>
    <div class="step-container">
      <div class="progress-step"><i class="fas fa-truck"></i></div>
      <div class="progress-label">On Way</div>
    </div>
    <div class="step-container">
      <div class="progress-step"><i class="fas fa-home"></i></div>
      <div class="progress-label">Delivered</div>
    </div>
  </div>
  
  <div class="alert alert-success rounded-4 py-3 mb-5 border-0 shadow-sm">
    <div class="row text-center">
      <div class="col-md-4 border-end">
        <div class="small text-muted text-uppercase fw-bold">Order ID</div>
        <div class="h5 fw-bold mb-0">#<?php echo $orderId; ?></div>
      </div>
      <div class="col-md-4 border-end">
        <div class="small text-muted text-uppercase fw-bold">Delivery Time</div>
        <div class="h5 fw-bold mb-0 text-primary">30-45 Mins</div>
      </div>
      <div class="col-md-4">
        <div class="small text-muted text-uppercase fw-bold">Total Paid</div>
        <div class="h5 fw-bold mb-0">Rs. <?php echo $total; ?></div>
      </div>
    </div>
  </div>
  
  <p class="text-muted"><i class="fas fa-hourglass-half me-2"></i> Please wait while our chefs prepare your fresh meal with love.</p>
  
  <div class="stats-summary">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h5 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i> Weekly Performance</h5>
        <div class="h3 fw-bold text-dark mb-1">Rs. 24,500 <span class="text-success small fs-6">+18%</span></div>
        <p class="small text-muted mb-0">Total earnings this week</p>
      </div>
      <div class="col-md-6">
        <div class="stat-mini-chart">
          <canvas id="miniGrowthChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex gap-3 justify-content-center mt-5">
    <a href="dashboard.php" class="btn btn-primary px-5 py-3 rounded-pill fw-bold">Back to Dashboard</a>
    <a href="buyfood.php" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">Order More</a>
  </div>
</div>

<script>
  const ctx = document.getElementById('miniGrowthChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
      datasets: [{
        data: [5, 8, 12, 10, 15, 20, 18],
        borderColor: '#008a00',
        borderWidth: 2,
        tension: 0.4,
        pointRadius: 0,
        fill: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { display: false },
        y: { display: false }
      }
    }
  });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>

</body>
</html>
