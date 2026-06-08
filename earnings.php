<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Earnings Reports</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link rel="stylesheet" href="background.css">
  <script>
    const userAuth = JSON.parse(localStorage.getItem('currentUser'));
    if (!userAuth || !userAuth.loggedIn || userAuth.role !== 'seller') {
      window.location.href = 'login.php';
    }
  </script>
</head>
<body class="d-flex flex-column">
<div id="preloader">
  <div class="preloader-content">
    <div class="preloader-logo">Home Chef</div>
  </div>
</div>
<header>
  <h1>Home Chef</h1>
  <button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
  </button>
  <nav>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
    <a href="myorders.php"><i class="fas fa-clipboard-list me-1"></i> My Orders</a>
    <a href="login.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
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
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="myorders.php"><i class="fas fa-clipboard-list me-2"></i> My Orders</a>
    <a href="login.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </nav>
</div>
<section class="page-hero">
  <h2>Earnings <span class="primary-text">Reports</span></h2>
  <p><i class="fas fa-chart-line me-2 primary-text"></i> Track your sales performance and business growth</p>
</section>
<div class="container py-5">
  <div class="row g-4 mb-5">
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
      <div class="card h-100 p-4 text-center">
        <i class="fas fa-sun primary-text fs-1 mb-3"></i>
        <h3 class="fs-3 text-dark fw-bold">Today's Sales</h3>
        <div class="display-6 primary-text fw-bold my-3" id="todayEarnings">Rs. 3,200</div>
        <p class="small text-muted text-uppercase mb-0">Daily Earnings</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
      <div class="card h-100 p-4 text-center">
        <i class="fas fa-calendar-alt primary-text fs-1 mb-3"></i>
        <h3 class="fs-3 text-dark fw-bold">Monthly Sales</h3>
        <div class="display-6 primary-text fw-bold my-3" id="monthEarnings">Rs. 42,500</div>
        <p class="small text-muted text-uppercase mb-0">Accumulated Earnings</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
      <div class="card h-100 p-4 text-center">
        <i class="fas fa-wallet primary-text fs-1 mb-3"></i>
        <h3 class="fs-3 text-dark fw-bold">Life Time</h3>
        <div class="display-6 primary-text fw-bold my-3" id="totalEarnings">Rs. 185,000</div>
        <p class="small text-muted text-uppercase mb-0">Total Sales Earnings</p>
      </div>
    </div>
  </div>
  <div class="card p-4 mb-5" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fs-4 primary-text fw-bold">Growth Graph</h5>
        <span class="badge bg-primary px-3 py-2 rounded-pill small">Monthly Performance</span>
    </div>
    <div style="height: 300px;">
        <canvas id="monthlyChart"></canvas>
    </div>
  </div>
  <div class="card p-4 p-md-5" style="border-radius: 20px;" data-aos="fade-up">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <i class="fas fa-wallet primary-text fs-2 mb-3"></i>
        <h3 class="luxury-font text-dark fw-bold">Balance Withdrawal</h3>
        <p class="text-muted lead">Your current balance ready for transfer to your chosen bank account.</p>
        <div class="display-5 primary-text fw-bold my-3" id="availableBalance">Rs. 42,500</div>
      </div>
      <div class="col-lg-4 text-center text-lg-end">
        <button class="btn btn-primary px-5 py-3 fs-5 rounded-pill" id="withdrawBtn">WITHDRAW FUNDS</button>
        <p class="small text-muted mt-3">Minimum withdrawal amount: Rs. 1,000</p>
      </div>
    </div>
  </div>
</div>
<footer class="luxury-footer">
  <div class="container text-center">
    <div class="footer-brand mb-3">Home Chef</div>
    <p class="small text-muted opacity-75">Professional Earnings Dashboard.</p>
    <div class="pt-4 border-top border-secondary opacity-50 small mt-4">
      © 2026 Home Chef — All Rights Reserved. <i class="fas fa-heart primary-text"></i> Serving happiness since 2024.
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
  async function loadEarnings() {
    try {
      const user = JSON.parse(localStorage.getItem('currentUser'));
      const sellerId = user ? user.id : '';
      const response = await fetch('api/dashboard_stats.php?sellerId=' + sellerId);
      const result = await response.json();
      if (result.success && result.stats) {
        const stats = result.stats;
        document.getElementById("todayEarnings").innerText = `Rs. ${stats.todayRevenue.toLocaleString()}`;
        document.getElementById("totalEarnings").innerText = `Rs. ${stats.totalEarnings.toLocaleString()}`;
        document.getElementById("monthEarnings").innerText = `Rs. ${stats.totalEarnings.toLocaleString()}`; 
        document.getElementById("availableBalance").innerText = `Rs. ${stats.totalEarnings.toLocaleString()}`;
        
        
        const mockGrowth = [
            stats.totalEarnings * 0.4, 
            stats.totalEarnings * 0.6, 
            stats.totalEarnings * 0.7, 
            stats.totalEarnings * 0.85, 
            stats.totalEarnings * 0.9, 
            stats.totalEarnings
        ];
        initChart(mockGrowth);
      }
    } catch (error) {
      console.error("Error loading earnings:", error);
    }
  }

  function initChart(data = [28500, 31200, 35800, 39800, 42500, 46800]) {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    if (window.myChart) window.myChart.destroy();
    window.myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
          label: 'Total Sales (Rs.)',
          data: data,
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          borderWidth: 3,
          tension: 0.4,
          fill: true,
          pointBackgroundColor: '#10b981'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { labels: { color: '#2d3436', weight: 'bold' } } },
        scales: {
          y: { grid: { color: 'rgba(0, 0, 0, 0.05)' }, ticks: { color: '#636e72' } },
          x: { grid: { display: false }, ticks: { color: '#636e72' } }
        }
      }
    });
  }
  function showNotification(msg, isErr = false) {
    const div = document.createElement('div');
    div.className = 'custom-alert';
    div.style.background = isErr ? '#ff4757' : '#2ecc71';
    div.style.color = '#fff';
    div.innerHTML = `<i class="fas ${isErr ? 'fa-exclamation-circle' : 'fa-check-circle'} me-2"></i> ${msg}`;
    document.body.appendChild(div);
    setTimeout(() => { div.style.opacity = '0'; setTimeout(() => div.remove(), 400); }, 3000);
  }
  document.getElementById('withdrawBtn').addEventListener('click', () => {
    showNotification("💰 Withdrawal request submitted successfully! Funds will arrive in 3-5 days.");
  });
  window.addEventListener('DOMContentLoaded', () => {
    loadEarnings();
  });
  window.addEventListener('load', () => {
    const loader = document.getElementById('preloader');
    setTimeout(() => {
      loader.classList.add('preloader-hidden');
    }, 600);
  });
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

