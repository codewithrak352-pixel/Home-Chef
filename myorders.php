<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once 'config/db.php';

$userId = $_SESSION['user_id'];
$role = $_SESSION['user_role'];

// Fetch orders based on role
if ($role === 'seller') {
    // Orders where this user is the seller of at least one item
    $stmt = $pdo->prepare("
        SELECT o.*, u.fullName as customer_name 
        FROM orders o 
        JOIN users u ON o.customer_id = u.id 
        WHERE o.id IN (SELECT order_id FROM order_items WHERE seller_id = ?)
        ORDER BY o.created_at DESC
    ");
    $stmt->execute([$userId]);
} else {
  
    $stmt = $pdo->prepare("
        SELECT o.*, 'Home Chef' as seller_name 
        FROM orders o 
        WHERE o.customer_id = ? 
        ORDER BY o.created_at DESC
    ");
    $stmt->execute([$userId]);
}
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .order-card { background: #fff; border-radius: 20px; padding: 25px; border: 1px solid var(--border-color); margin-bottom: 20px; transition: var(--transition); }
    .order-card:hover { border-color: var(--primary); box-shadow: var(--shadow-sm); }
    .status-badge { padding: 6px 15px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; }
    .status-pending { background: #fff8e1; color: #ffa000; }
    .status-completed { background: #e8f5e9; color: #2e7d32; }
    .status-cancelled { background: #ffebee; color: #c62828; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_dashboard.php'; ?>

<section class="py-5" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1543353071-873f17a7a088?w=1600&auto=format') center/cover no-repeat;">
  <div class="container py-4 text-center" data-aos="fade-down">
    <h2 class="display-5 fw-bold text-white">Order <span class="primary-text">History</span></h2>
    <p class="text-white opacity-90">Track your recent activity and manage your meal box.</p>
  </div>
</section>

<div class="container py-5 mb-5">
  <div class="row">
    <div class="col-lg-10 mx-auto">
      <?php if (empty($orders)): ?>
        <div class="text-center py-5" data-aos="fade-up">
          <i class="fas fa-box-open fs-1 text-muted mb-3 opacity-25"></i>
          <h3 class="text-muted">No orders found.</h3>
          <a href="buyfood.php" class="btn btn-primary mt-3 px-5 rounded-pill fw-bold">Start Ordering</a>
        </div>
      <?php else: ?>
        <?php foreach ($orders as $order): ?>
          <div class="order-card" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
              <div>
                <div class="small text-muted mb-1">Order #<?php echo $order['id']; ?> • <?php echo date('M d, Y', strtotime($order['created_at'])); ?></div>
                <h5 class="fw-bold mb-0">
                  <?php echo ($role === 'seller') ? "Customer: " . $order['customer_name'] : "Home Chef Weekly Box"; ?>
                </h5>
              </div>
              <div class="text-end">
                <div class="h5 fw-bold text-primary mb-1">Rs. <?php echo number_format($order['total_amount']); ?></div>
                <span class="status-badge status-<?php echo strtolower($order['status']); ?>">
                  <?php echo $order['status']; ?>
                </span>
              </div>
            </div>
            <hr class="my-3">
            <div class="d-flex justify-content-between align-items-center">
              <div class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $order['delivery_address']; ?></div>
              <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold">View Details</button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

</body>
</html>
