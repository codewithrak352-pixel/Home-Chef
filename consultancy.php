<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Cooking Consultancy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
</head>
<body>
<?php include 'header_main.php'; ?>

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
    <a href="cart.php" id="mobileOpenCartBtn" class="nav-icon-highlight"><i class="fas fa-shopping-bag me-2"></i> Cart <span id="mobileCartCountBadge" class="cart-badge">0</span></a>
  </nav>
</div>
<section class="page-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1600&auto=format') center/cover no-repeat;">
  <div class="container text-center">
    <h2 class="display-3 fw-bold text-white">Cooking <span class="primary-text">Consultancy</span></h2>
    <p class="text-white opacity-90"><i class="fas fa-hat-chef me-2 primary-text"></i> Learn professional cooking techniques • Expert guidance from certified chefs</p>
  </div>
</section>
<div class="container my-5">
  <div class="text-center mb-5" data-aos="fade-up">
    <span class="badge bg-dark text-white border px-3 py-2 rounded-pill mb-3"><i class="fas fa-graduation-cap me-1"></i> EXPERT COACHING</span>
    <h2 class="section-title-luxury">Personalized Cooking Sessions</h2>
    <p class="mt-2 text-muted">Improve your cooking skills with one-on-one sessions with our expert chefs.</p>
  </div>
  <div class="row g-5">
    <div class="col-md-6" data-aos="fade-up" data-aos-delay="50">
      <div class="card h-100 p-4 text-center">
        <div class="card-body">
          <i class="fas fa-headset primary-text fs-1 mb-4"></i>
          <h3 class="fs-3 text-dark fw-bold">Live Cooking Help</h3>
          <span class="badge bg-dark text-white border px-3 py-1 small rounded-pill mt-2">Live Support</span>
          <p class="small text-muted mt-3 mb-4">Receive immediate video guidance as you prepare your meal. Perfect for learning complex techniques or getting real-time advice in the kitchen.</p>
          <div class="mb-4">
            <span class="fs-4 primary-text fw-bold">Rs. 500</span>
            <span class="small text-muted"> / per session</span>
          </div>
          <button class="btn btn-primary consultancy-btn w-100 py-3 rounded-pill" data-service="Live Cooking Help" data-price="500">BOOK NOW</button>
        </div>
      </div>
    </div>
    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
      <div class="card h-100 p-4 text-center">
        <div class="card-body">
          <i class="fas fa-video primary-text fs-1 mb-4"></i>
          <h3 class="fs-3 text-dark fw-bold">Private Masterclass</h3>
          <span class="badge bg-dark text-white border px-3 py-1 small rounded-pill mt-2">Exclusive 1-on-1</span>
          <p class="small text-muted mt-3 mb-4">A premium session with our certified chefs. Deep-dive into recipe secrets, menu planning, and professional cooking skills.</p>
          <div class="mb-4">
            <span class="fs-4 primary-text fw-bold">Rs. 1,000</span>
            <span class="small text-muted"> / per class</span>
          </div>
          <button class="btn btn-primary consultancy-btn w-100 py-3 rounded-pill" data-service="Private Masterclass" data-price="1000">BOOK NOW</button>
        </div>
      </div>
    </div>
  </div>
  <div class="card mt-5 p-0 overflow-hidden" data-aos="fade-up" data-aos-delay="150">
    <div class="row g-0 align-items-center">
      <div class="col-md-8">
        <div class="p-5">
           <span class="badge bg-dark text-white border px-3 py-2 rounded-pill small mb-4">MONTHLY PROGRAM</span>
           <h3 class="display-6 text-dark fw-bold mb-3">Monthly Cooking Course</h3>
           <p class="text-muted mb-4 lead">4 curated weekly classes • Detailed recipe book included • Priority chat support • Professional cooking tips and techniques.</p>
           <div class="mb-4">
             <span class="display-6 primary-text fw-bold">Rs. 3,500</span>
             <span class="text-muted"> / per month</span>
           </div>
           <button class="btn btn-primary px-5 py-3 consultancy-btn" data-service="Monthly Cooking Course" data-price="3500">ENROLL NOW</button>
        </div>
      </div>
      <div class="col-md-4 text-center p-5" style="background: rgba(212,175,55,0.05);">
          <div class="d-flex justify-content-center gap-3 mb-3">
              <div style="width: 80px; height: 80px; border: 1px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-user-chef primary-text fs-2"></i>
              </div>
              <div style="width: 80px; height: 80px; border: 1px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-award primary-text fs-2"></i>
              </div>
          </div>
          <p class="small primary-text fw-bold text-uppercase">Certified Expert Chefs</p>
      </div>
    </div>
  </div>
  <div class="mt-5 text-center" data-aos="fade-up">
    <div class="d-flex flex-wrap justify-content-center gap-4">
      <div class="badge bg-dark text-white border px-3 py-2"><i class="fas fa-check-circle primary-text me-2"></i> 500+ Students Trained</div>
      <div class="badge bg-dark text-white border px-3 py-2"><i class="fas fa-check-circle primary-text me-2"></i> Verified Professional Chefs</div>
      <div class="badge bg-dark text-white border px-3 py-2"><i class="fas fa-check-circle primary-text me-2"></i> Easy Online Scheduling</div>
    </div>
  </div>
</div>
<footer class="luxury-footer">
  <div class="container text-center">
    <div class="footer-brand mb-3">Home Chef</div>
    <p class="small text-muted opacity-75">Learn from the best. Master the professional way.</p>
    <div class="pt-4 border-top border-secondary opacity-50 small mt-4">
      © 2026 Home Chef — All Rights Reserved. <i class="fas fa-heart primary-text"></i> Serving happiness since 2024.
    </div>
  </div>
</footer>


<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="modalChefName">Book Consultancy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="bookingForm">
          <input type="hidden" id="modalChefId">
          <input type="hidden" id="modalChefPrice">
          
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted uppercase">Select Session Date</label>
            <input type="date" class="form-control form-control-lg rounded-3" id="bookingDate" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted uppercase">Preferred Time</label>
            <input type="time" class="form-control form-control-lg rounded-3" id="bookingTime" required>
          </div>

          <div class="mb-4">
            <label class="form-label small fw-bold text-muted uppercase">What do you want to learn?</label>
            <textarea class="form-control rounded-3" id="bookingNotes" rows="3" placeholder="e.g. How to make perfect Biryani, or dough techniques."></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">SCHEDULE SESSION</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  let services = [];
  let isRoyalMember = localStorage.getItem("HomeChefRoyalMember") === "true";

  async function fetchConsultancy() {
    try {
        const response = await fetch('api/dishes.php');
        const result = await response.json();
        if (result.success) {
            
            const names = ['Live Cooking Help', 'Private Masterclass', 'Monthly Cooking Course'];
            services = result.dishes.filter(d => names.includes(d.dish_name));
            renderConsultancy();
        }
    } catch (e) {
        console.error("Error fetching consultancy services:", e);
    }
  }

  function renderConsultancy() {
    const mainRow = document.querySelector('.row.g-5');
    const courseCard = document.querySelector('.card.mt-5.p-0');
    
    if (!mainRow || !courseCard) return;

    const liveHelp = services.find(s => s.dish_name === 'Live Cooking Help');
    const masterclass = services.find(s => s.dish_name === 'Private Masterclass');
    const course = services.find(s => s.dish_name === 'Monthly Cooking Course');

    let mainHtml = '';
    [liveHelp, masterclass].forEach((s, idx) => {
        if (!s) return;
        const finalPrice = Math.floor(s.price * (isRoyalMember ? 0.85 : 1));
        mainHtml += `
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="${50 * (idx+1)}">
              <div class="card h-100 p-4 text-center">
                <div class="card-body">
                  <i class="fas ${s.dish_name === 'Live Cooking Help' ? 'fa-headset' : 'fa-video'} primary-text fs-1 mb-4"></i>
                  <h3 class="fs-3 text-dark fw-bold">${s.dish_name}</h3>
                  <p class="small text-muted mt-3 mb-4">${s.description}</p>
                  <div class="mb-4">
                    <span class="fs-4 primary-text fw-bold">Rs. ${finalPrice}</span>
                    <span class="small text-muted"> / per session</span>
                    ${isRoyalMember ? '<br><span class="badge bg-primary text-white">-15% OFF</span>' : ''}
                  </div>
                  <button class="btn btn-primary consultancy-btn w-100 py-3 rounded-pill" data-id="${s.id}" data-name="${s.dish_name}" data-price="${s.price}">BOOK NOW</button>
                </div>
              </div>
            </div>`;
    });
    mainRow.innerHTML = mainHtml;

    if (course) {
        const finalCoursePrice = Math.floor(course.price * (isRoyalMember ? 0.85 : 1));
        courseCard.innerHTML = `
            <div class="row g-0 align-items-center">
              <div class="col-md-8">
                <div class="p-5">
                   <span class="badge bg-dark text-white border px-3 py-2 rounded-pill small mb-4">MONTHLY PROGRAM</span>
                   <h3 class="display-6 text-dark fw-bold mb-3">${course.dish_name}</h3>
                   <p class="text-muted mb-4 lead">${course.description}</p>
                   <div class="mb-4">
                     <span class="display-6 primary-text fw-bold">Rs. ${finalCoursePrice}</span>
                     <span class="text-muted"> / per month</span>
                     ${isRoyalMember ? '<br><span class="badge bg-primary text-white">-15% OFF</span>' : ''}
                   </div>
                   <button class="btn btn-primary px-5 py-3 consultancy-btn" data-id="${course.id}" data-name="${course.dish_name}" data-price="${course.price}">ENROLL NOW</button>
                </div>
              </div>
              <div class="col-md-4 text-center p-5" style="background: rgba(16,185,129,0.05);">
                  <div class="d-flex justify-content-center gap-3 mb-3">
                      <div style="width: 80px; height: 80px; border: 1px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-utensils primary-text fs-2"></i>
                      </div>
                      <div style="width: 80px; height: 80px; border: 1px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-award primary-text fs-2"></i>
                      </div>
                  </div>
                  <p class="small primary-text fw-bold text-uppercase">Certified Expert Chefs</p>
              </div>
            </div>`;
    }



    document.querySelectorAll('.consultancy-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = btn.dataset.price;
        
        document.getElementById('modalChefId').value = id;
        document.getElementById('modalChefName').innerText = `Book ${name}`;
        document.getElementById('modalChefPrice').value = price;
        
        const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
        modal.show();
      });
    });
  }

  document.getElementById('bookingForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const id = document.getElementById('modalChefId').value;
    const name = document.getElementById('modalChefName').innerText.replace('Book ', '');
    const price = parseInt(document.getElementById('modalChefPrice').value);
    const date = document.getElementById('bookingDate').value;
    const time = document.getElementById('bookingTime').value;
    const notes = document.getElementById('bookingNotes').value;

    addToCart(id, name, price, date, time, notes);
    bootstrap.Modal.getInstance(document.getElementById('bookingModal')).hide();
  });

  function showNotification(msg, isErr = false) {
    const div = document.createElement('div');
    div.className = 'custom-alert';
    div.style.background = isErr ? '#ff4757' : '#2ecc71';
    div.style.color = '#fff';
    div.innerHTML = `<i class="fas ${isErr ? 'fa-exclamation-circle' : 'fa-check-circle'} me-2"></i> ${msg}`;
    document.body.appendChild(div);
    setTimeout(() => {
        div.style.opacity = '0';
        div.style.transform = 'translateY(-20px)';
        setTimeout(() => div.remove(), 400);
    }, 2400);
  }

  function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    const count = cart.reduce((acc, i) => acc + (i.quantity || 1), 0);
    const badge = document.getElementById("cartCountBadge");
    if(badge) badge.innerText = count;
  }

  function addToCart(id, name, price, date = null, time = null, notes = null) {
    let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    const finalPrice = Math.floor(price * (isRoyalMember ? 0.85 : 1));
    
    cart.push({ 
        id, 
        name, 
        price: finalPrice, 
        quantity: 1,
        date,
        time,
        notes,
        type: 'consultancy'
    });
    
    localStorage.setItem("HomeChefCart", JSON.stringify(cart));
    updateCartBadge();
    showNotification(`${name} session added to your basket for ${date}`);
  }

  fetchConsultancy();
  updateCartBadge();
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

    // Sync cart badges
    const desktopCartBtn = document.getElementById('openCartBtn');
    const mobileCartBtn = document.getElementById('mobileOpenCartBtn');
    const desktopBadge = document.getElementById('cartCountBadge');
    const mobileBadge = document.getElementById('mobileCartCountBadge');

    function syncCartBadges() {
      const cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
      const count = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
      if (desktopBadge) desktopBadge.textContent = count;
      if (mobileBadge) mobileBadge.textContent = count;
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
  }

  initMobileMenu();
</script>
</body>
</html>

