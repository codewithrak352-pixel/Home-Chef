<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Customer Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <script>
    const userAuth = JSON.parse(localStorage.getItem('currentUser'));
    if (!userAuth || !userAuth.loggedIn || userAuth.role !== 'customer') {
      window.location.href = 'login.php';
    }
  </script>
</head>
<body class="d-flex flex-column">
<header>
  <h1>My Dashboard</h1>
  <button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
  </button>
  <nav>
    <a href="homechef.php"><i class="fas fa-home me-1"></i> Home</a>
    <a href="profile.php"><i class="fas fa-user-circle me-1"></i> Profile</a>
    <a href="login.php" class="text-danger fw-bold"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
  </nav>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-header">
    <h2 style="margin: 0; color: var(--primary);">Menu</h2>
    <button class="mobile-menu-close" id="mobileMenuClose">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <nav>
    <a href="homechef.php"><i class="fas fa-home me-2"></i> Home</a>
    <a href="profile.php"><i class="fas fa-user-circle me-2"></i> Profile</a>
    <a href="login.php" class="text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </nav>
</div>
<section class="page-hero">
  <h2>Welcome Back, <span class="primary-text" id="userName">User</span></h2>
  <p><i class="fas fa-history me-2 primary-text"></i> Track your orders and manage your gourmet experiences</p>
</section>
<div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card p-4 shadow-sm border-0 rounded-4">
        <h4 class="fw-bold mb-4">Your Recent Orders</h4>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="bg-light">
              <tr class="small text-uppercase fw-bold text-muted">
                <th>Order #</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody id="ordersTable">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card p-4 shadow-sm border-0 rounded-4 bg-primary text-white mb-4">
        <h5 class="fw-bold mb-3">Royal Membership</h5>
        <div id="membershipStatus">Checking status...</div>
      </div>
      <div class="card p-4 shadow-sm border-0 rounded-4">
        <h5 class="fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="homechef.php#special" class="text-decoration-none text-dark"><i class="fas fa-search me-2 primary-text"></i> Order New Food</a></li>
          <li class="mb-2"><a href="profile.php" class="text-decoration-none text-dark"><i class="fas fa-user-edit me-2 primary-text"></i> Edit Profile</a></li>
          <li class="mb-2"><a href="services.php" class="text-decoration-none text-dark"><i class="fas fa-concierge-bell me-2 primary-text"></i> Book a Service</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<footer class="luxury-footer">
  <div class="container text-center">
    <div class="footer-brand mb-3">Home Chef</div>
    <p class="small text-muted">Homemade with love, delivered with care.</p>
  </div>
</footer>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
  const user = JSON.parse(localStorage.getItem('currentUser'));
  document.getElementById('userName').innerText = user.fullName || 'User';

  async function fetchOrders() {
    try {
      const response = await fetch(`api/orders.php?customerId=${user.id}`);
      const result = await response.json();
      if (result.success) {
        renderOrders(result.orders);
      }
    } catch (e) { console.error(e); }
  }

  function renderOrders(orders) {
    const tbody = document.getElementById('ordersTable');
    if (orders.length === 0) {
      tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4">No orders found.</td></tr>';
      return;
    }
    tbody.innerHTML = orders.map(o => `
      <tr>
        <td class="fw-bold">#${o.id}</td>
        <td><span class="badge ${getStatusBadge(o.status)}">${o.status.toUpperCase()}</span></td>
        <td class="fw-bold primary-text">Rs. ${o.total_amount}</td>
        <td class="small text-muted">${new Date(o.created_at).toLocaleDateString()}</td>
      </tr>
    `).join('');
  }

  function getStatusBadge(status) {
    switch(status) {
      case 'pending': return 'bg-warning text-dark';
      case 'accepted': return 'bg-info text-white';
      case 'completed': return 'bg-success text-white';
      case 'cancelled': return 'bg-danger text-white';
      default: return 'bg-secondary';
    }
  }

  function checkMembership() {
    const isMember = localStorage.getItem("HomeChefRoyalMember") === "true";
    const container = document.getElementById('membershipStatus');
    if (isMember) {
      container.innerHTML = '<p class="mb-0 small"><i class="fas fa-crown me-2"></i> Active Member - 15% Off everything!</p>';
    } else {
      container.innerHTML = '<p class="mb-0 small">Join the Royal Club for exclusive benefits.</p><a href="homechef.php#exclusive" class="btn btn-light btn-sm mt-2 rounded-pill">Learn More</a>';
    }
  }

  fetchOrders();
  checkMembership();
</script>

<script>
  // Mobile Menu Functionality
  function initMobileMenu() {
    const toggle = document.getElementById('mobileMenuToggle');
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileMenuOverlay');
    const close = document.getElementById('mobileMenuClose');

    function openMenu() {
      menu.classList.add('active');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      menu.classList.remove('active');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    toggle?.addEventListener('click', openMenu);
    close?.addEventListener('click', closeMenu);
    overlay?.addEventListener('click', closeMenu);
  }

  initMobileMenu();
</script>
</body>
</html>
