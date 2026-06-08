<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home Chef | Fresh Weekly Meal Kit Delivery</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .hero-home {
      height: 100vh;
      background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('assets/hero.png') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }
    .hero-home h2 { font-size: clamp(3rem, 8vw, 6rem); margin-bottom: 10px; }
    .hero-home p { font-size: 1.5rem; margin-bottom: 40px; }
    .btn-hero { padding: 18px 40px; font-size: 1.1rem; font-weight: 700; border-radius: 50px; transition: var(--transition); }
    .btn-hero-primary { background: var(--primary); color: #fff; border: none; }
    .btn-hero-secondary { background: transparent; color: #fff; border: 2px solid #fff; }
    .btn-hero:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
    .tab-nav { border: none; justify-content: center; margin-bottom: 40px; }
    .tab-nav .nav-link { font-family: var(--font-serif); font-size: 1.25rem; color: var(--text-muted); border: none; padding: 10px 25px; border-bottom: 3px solid transparent; }
    .tab-nav .nav-link.active { color: var(--primary); border-bottom-color: var(--primary); background: transparent; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="hero-home">
  <div class="container" data-aos="zoom-out">
    <h2>Meet Home Chef</h2>
    <p>Let’s cook together</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="buyfood.php" class="btn btn-hero btn-hero-primary">See Pricing & Meals</a>
      <a href="family.php" class="btn btn-hero btn-hero-secondary">Family Plans</a>
    </div>
  </div>
</section>

<section class="benefit-icons-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up">
        <div class="benefit-item">
          <div class="benefit-icon"><i class="fas fa-utensils"></i></div>
          <h4 class="benefit-title">Meal Kits That Fit Your Needs</h4>
          <p class="text-muted">Choose from classic kits or Oven-Ready options for ultimate convenience.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="benefit-item">
          <div class="benefit-icon"><i class="fas fa-sliders-h"></i></div>
          <h4 class="benefit-title">Endlessly Customizable</h4>
          <p class="text-muted">Use our "Customize It" tool to swap, double, or upgrade your proteins.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="benefit-item">
          <div class="benefit-icon"><i class="fas fa-leaf"></i></div>
          <h4 class="benefit-title">Fresh, Pre-Portioned Ingredients</h4>
          <p class="text-muted">Everything you need delivered in an insulated box to maintain peak freshness.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title-luxury mb-4">Explore our menu</h2>
      <ul class="nav tab-nav" id="menuTabs">
        <li class="nav-item"><button class="nav-link active" data-category="Gourmet">Greatest Hits</button></li>
        <li class="nav-item"><button class="nav-link" data-category="American">Easy-Prep</button></li>
        <li class="nav-item"><button class="nav-link" data-category="Healthy">Fresh-Start</button></li>
        <li class="nav-item"><button class="nav-link" data-category="Vegetarian">Plant-Based</button></li>
      </ul>
    </div>
    <div class="row g-4" id="popularDishes"></div>
    <div class="text-center mt-5">
      <a href="buyfood.php" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">View Full Menu</a>
    </div>
  </div>
</section>

<section class="budget-section">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title-luxury">Built for your budget</h2>
      <p class="text-muted fs-5">All your meals with prices as low as:</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-3" data-aos="flip-left">
        <div class="price-tier"><div class="label">Dinner</div><div class="price">Rs. 899</div></div>
      </div>
      <div class="col-md-3" data-aos="flip-left" data-aos-delay="100">
        <div class="price-tier"><div class="label">Lunch</div><div class="price">Rs. 649</div></div>
      </div>
      <div class="col-md-3" data-aos="flip-left" data-aos-delay="200">
        <div class="price-tier"><div class="label">Dessert</div><div class="price">Rs. 399</div></div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer_main.php'; ?>

<script>
  async function loadPopular(category = 'Gourmet') {
    const res = await fetch(`api/dishes.php?category=${category}`);
    const data = await res.json();
    if (data.success) {
      const container = document.getElementById('popularDishes');
      container.innerHTML = data.dishes.slice(0, 4).map((d, i) => `
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="${i * 100}">
          <div class="luxury-card h-100">
            <a href="dish-details.php?id=${d.id}">
              <img src="${d.image_url}" class="w-100 object-fit-cover" style="height: 200px;">
            </a>
            <div class="p-3 text-center">
              <h5 class="fw-bold mb-1 serif-font">${d.name}</h5>
              <p class="text-muted small mb-3">${d.description.substring(0, 60)}...</p>
              <a href="dish-details.php?id=${d.id}" class="btn btn-primary btn-sm w-100 rounded-pill">View Recipe</a>
            </div>
          </div>
        </div>
      `).join('');
    }
  }

  document.querySelectorAll('#menuTabs .nav-link').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#menuTabs .nav-link').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      loadPopular(btn.dataset.category);
    });
  });

  loadPopular();
</script>
</body>
</html>
