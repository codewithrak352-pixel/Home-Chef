<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Our Services</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
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
    <a href="homechef.php"><i class="fas fa-home me-1"></i> Home</a>
    <a href="services.php"><i class="fas fa-concierge-bell me-1"></i> Services</a>
    <a href="register.php"><i class="fas fa-user-plus me-1"></i> Register</a>
    <a href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
    <a href="checkout.php"><i class="fas fa-credit-card me-1"></i> Checkout</a>
    <a href="#" id="openCartBtn" class="nav-icon-highlight"><i class="fas fa-shopping-bag"></i> Cart <span id="cartCountBadge" class="cart-badge">0</span></a>
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
    <a href="services.php"><i class="fas fa-concierge-bell me-2"></i> Services</a>
    <a href="register.php"><i class="fas fa-user-plus me-2"></i> Register</a>
    <a href="login.php"><i class="fas fa-sign-in-alt me-2"></i> Login</a>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="checkout.php"><i class="fas fa-credit-card me-2"></i> Checkout</a>
    <a href="#" id="mobileOpenCartBtn" class="nav-icon-highlight"><i class="fas fa-shopping-bag me-2"></i> Cart <span id="mobileCartCountBadge" class="cart-badge">0</span></a>
  </nav>
</div>
<section class="page-hero">
  <h2>Our <span class="primary-text">Professional Services</span></h2>
  <p><i class="fas fa-utensils me-2 primary-text"></i> Professional food delivery and chef services for your home</p>
</section>
<div class="container my-5">
  <div class="text-center mb-5" data-aos="fade-up">
    <span class="badge bg-dark text-white px-3 py-2 rounded-pill border mb-3"><i class="fas fa-concierge-bell me-1"></i> WHAT WE OFFER</span>
    <h2 class="section-title-luxury">Our Service Categories</h2>
    <p class="mt-2 text-muted">From fresh home-cooked meals to hiring personal chefs for your home.</p>
  </div>
  <div class="row g-5">
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
      <div class="card h-100 text-center p-0 overflow-hidden rounded-4">
        <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&auto=format&fit=crop" class="card-img-top" alt="Home Cooked" style="height: 220px; object-fit: cover;">
        <div class="card-body p-4">
          <h3 class="card-title fw-bold text-dark mb-3">Home Cooked Food</h3>
          <p class="text-muted small mb-4">Order healthy and fresh home-cooked meals prepared by expert chefs. We ensure hygiene, quality, and the authentic taste of home in every dish.</p>
          <a href="buyfood.php" class="btn btn-primary w-100 text-decoration-none rounded-pill">Explore Menu</a>
        </div>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
      <div class="card h-100 text-center p-0 overflow-hidden rounded-4">
        <img src="https://images.unsplash.com/photo-1581299894007-aaa50297cf16?w=800&auto=format&fit=crop" class="card-img-top" alt="Personal Chef" style="height: 220px; object-fit: cover;">
        <div class="card-body p-4">
          <h3 class="card-title fw-bold text-dark mb-3">Hire a Personal Chef</h3>
          <p class="text-muted small mb-4">Book a professional chef for your home events, family dinners, or special occasions. We provide chefs for all types of cuisines.</p>
          <a href="hirechef.php" class="btn btn-primary w-100 text-decoration-none rounded-pill">Book a Chef</a>
        </div>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
      <div class="card h-100 text-center p-0 overflow-hidden rounded-4">
        <img src="https://images.unsplash.com/photo-1556910110-ad52744d7c1f?w=800&auto=format&fit=crop" class="card-img-top" alt="Consultancy" style="height: 220px; object-fit: cover;">
        <div class="card-body p-4">
          <h3 class="card-title fw-bold text-dark mb-3">Food Consultancy</h3>
          <p class="text-muted small mb-4">Expert advice on menu planning, nutrition, and professional cooking techniques. We provide expert guidance for every food service need.</p>
          <a href="consultancy.php" class="btn btn-primary w-100 text-decoration-none rounded-pill">Get Consultancy</a>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-5 p-5 rounded-4" style="background: #fdfdfd; border: 1px solid var(--border-color);" data-aos="fade-up">
    <div class="row g-4 text-center">
      <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
        <i class="fas fa-check-circle primary-text fs-2 mb-2"></i>
        <h6 class="text-dark fw-bold">Verified Chefs</h6>
        <p class="small text-muted">Thorough background checks</p>
      </div>
      <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
        <i class="fas fa-shield-alt primary-text fs-2 mb-2"></i>
        <h6 class="text-dark fw-bold">Hygiene Standards</h6>
        <p class="small text-muted">Strict food safety protocols</p>
      </div>
      <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
        <i class="fas fa-clock primary-text fs-2 mb-2"></i>
        <h6 class="text-dark fw-bold">Timely Service</h6>
        <p class="small text-muted">Punctual and reliable delivery</p>
      </div>
      <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="400">
        <i class="fas fa-heart primary-text fs-2 mb-2"></i>
        <h6 class="text-dark fw-bold">Homemade Taste</h6>
        <p class="small text-muted">Authentic flavor from home</p>
      </div>
    </div>
  </div>
</div>
<footer class="luxury-footer">
  <div class="container text-center">
    <div class="footer-brand mb-3">Home Chef</div>
    <p class="small text-muted opacity-75">Your professional platform for home-cooked food, personal chefs, and expert food consultancy.</p>
    <div class="d-flex justify-content-center gap-3 my-4">
      <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-x-twitter"></i></a>
    </div>
    <div class="pt-4 border-top border-secondary opacity-50 small">
      © 2026 Home Chef — All Rights Reserved. <i class="fas fa-heart primary-text"></i> Serving happiness since 2024.
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
  
  function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    const count = cart.reduce((acc, i) => acc + (i.quantity || 1), 0);
    const badge = document.getElementById("cartCountBadge");
    if(badge) badge.innerText = count;
  }
  document.getElementById("openCartBtn")?.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "cart.php";
  });
  updateCartBadge();
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

    let startX = 0;
    let startY = 0;
    let isDragging = false;

    function openMenu() {
      menu.classList.add('active');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
      menu.setAttribute('aria-hidden', 'false');
    }

    function closeMenu() {
      menu.classList.remove('active');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
      menu.setAttribute('aria-hidden', 'true');
    }

    toggle?.addEventListener('click', openMenu);
    close?.addEventListener('click', closeMenu);
    overlay?.addEventListener('click', closeMenu);

    // Swipe to close functionality
    menu?.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      isDragging = true;
    });

    menu?.addEventListener('touchmove', (e) => {
      if (!isDragging) return;

      const currentX = e.touches[0].clientX;
      const currentY = e.touches[0].clientY;
      const diffX = startX - currentX;
      const diffY = Math.abs(startY - currentY);

      if (diffX > 50 && diffY < 100) {
        closeMenu();
        isDragging = false;
      }
    });

    menu?.addEventListener('touchend', () => {
      isDragging = false;
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && menu.classList.contains('active')) {
        closeMenu();
      }
    });

    // Sync cart badges
    const desktopCartBtn = document.getElementById('openCartBtn');
    const mobileCartBtn = document.getElementById('mobileOpenCartBtn');
    const desktopBadge = document.getElementById('cartCountBadge');
    const mobileBadge = document.getElementById('mobileCartCountBadge');

    function syncCartBadges() {
      try {
        const cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
        const count = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        if (desktopBadge) desktopBadge.textContent = count;
        if (mobileBadge) mobileBadge.textContent = count;
      } catch (error) {
        console.warn('Error syncing cart badges:', error);
      }
    }

    // Initial sync
    syncCartBadges();

    // Listen for cart updates
    window.addEventListener('storage', (e) => {
      if (e.key === 'HomeChefCart') {
        syncCartBadges();
      }
    });

    // Handle mobile cart button click
    mobileCartBtn?.addEventListener('click', (e) => {
      e.preventDefault();
      closeMenu();
      desktopCartBtn.click();
    });

    // Prevent body scroll when menu is open
    menu.addEventListener('touchmove', (e) => {
      if (menu.classList.contains('active')) {
        e.preventDefault();
      }
    });
  }

  // Initialize mobile menu when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMobileMenu);
  } else {
    initMobileMenu();
  }
</script>
</body>
</html>

