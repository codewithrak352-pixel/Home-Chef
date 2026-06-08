<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Seller Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
</head>
<body>
<header>
  <h1>Seller Verification</h1>
  <button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
  </button>
  <nav>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
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
    <a href="login.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </nav>
</div>
<section class="page-hero">
  <h2>Seller <span class="primary-text">Verification</span></h2>
  <p><i class="fas fa-user-check me-2 primary-text"></i> Review and approve new seller registration requests carefully</p>
</section>
<div class="container py-5">
  <div class="row g-4 mb-5" data-aos="fade-up">
    <div class="col-md-6">
      <div class="card p-3 text-center" style="border-radius: 12px; border: 1px solid var(--border-color);">
        <div class="display-6 primary-text fw-bold" id="pendingCount">0</div>
        <div class="small text-muted text-uppercase fw-bold">Pending Requests</div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3 text-center" style="border-radius: 12px; border: 1px solid var(--border-color);">
        <div class="display-6 primary-text fw-bold" id="totalCount">0</div>
        <div class="small text-muted text-uppercase fw-bold">Total Requests</div>
      </div>
    </div>
  </div>
  <div id="sellersContainer" class="row g-4"></div>
</div>
<footer class="luxury-footer">
  <div class="container text-center">
    <div class="footer-brand mb-3">Home Chef Admin</div>
    <p class="small text-muted">Ensuring the quality of our home-cooking community.</p>
    <div class="pt-4 border-top border-secondary opacity-50 small mt-4">
      © 2026 Home Chef — All Rights Reserved. <i class="fas fa-shield-alt primary-text"></i>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
  let pendingSellers = [];

  async function fetchPendingSellers() {
    try {
      const response = await fetch('api/admin.php');
      const result = await response.json();
      if (result.success) {
        pendingSellers = result.sellers;
        renderSellers();
      }
    } catch (error) {
      console.error("Failed to fetch sellers:", error);
    }
  }

  function renderSellers() {
    const container = document.getElementById('sellersContainer');
    document.getElementById('pendingCount').innerText = pendingSellers.length;
    document.getElementById('totalCount').innerText = pendingSellers.length;
    if (pendingSellers.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-5"><i class="fas fa-check-circle primary-text fs-1 mb-3"></i><p class="text-muted">No pending requests at the moment.</p></div>';
      return;
    }
    container.innerHTML = pendingSellers.map(s => `
      <div class="col-md-6" data-aos="fade-up">
        <div class="card h-100 p-4 shadow-sm border">
          <div class="d-flex justify-content-between align-items-center mb-4">
             <h3 class="fs-3 text-dark fw-bold mb-0">${s.fullName}</h3>
             <span class="badge bg-primary rounded-pill">PENDING APPROVAL</span>
          </div>
          <div class="mb-3 small">
             <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Email:</span>
                <span class="text-dark">${s.email}</span>
             </div>
             <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">City:</span>
                <span class="text-dark">${s.city || 'N/A'}</span>
             </div>
             <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Specialty:</span>
                <span class="primary-text fw-bold">Chef</span>
             </div>
             <div class="mt-3 p-3 rounded" style="background: #f8f9fa; border: 1px solid var(--border-color);">
                <span class="text-muted d-block small mb-1 fw-bold">EXPERIENCE & SKILLS:</span>
                <p class="text-dark mb-0">${s.experience || 'No experience details provided.'}</p>
             </div>
          </div>
          <div class="d-flex gap-3 mt-4">
             <button class="btn btn-primary w-100 rounded-pill py-2" onclick="processApproval(${s.id}, 'approved')">APPROVE SELLER</button>
             <button class="btn btn-outline-danger w-100 rounded-pill py-2" onclick="processApproval(${s.id}, 'blocked')">DECLINE REQUEST</button>
          </div>
        </div>
      </div>
    `).join('');
  }

  async function processApproval(id, status) {
    try {
      const response = await fetch('api/admin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ sellerId: id, status: status })
      });
      const result = await response.json();
      if (result.success) {
        showNotification(status === 'approved' ? `✅ Seller approved successfully.` : `❌ Seller request declined.`, status !== 'approved');
        fetchPendingSellers();
      } else {
        showNotification(result.message, true);
      }
    } catch (error) {
      showNotification("Error updating status", true);
    }
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

  fetchPendingSellers();
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

