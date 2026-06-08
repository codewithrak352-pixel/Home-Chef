<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Family Plan | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .family-hero { height: 500px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('assets/family.png') center/cover no-repeat; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; }
    .family-hero h2 { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; }
    .benefit-card { background: #fff; border: 1px solid var(--border-color); border-radius: 20px; padding: 40px; height: 100%; transition: var(--transition); }
    .benefit-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-lg); }
    .benefit-icon-lg { font-size: 3.5rem; color: var(--primary); margin-bottom: 25px; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="family-hero">
  <div class="container" data-aos="zoom-out">
    <h2>The Meal Kit That <br>Families Love</h2>
    <p class="fs-4 mt-3 opacity-90">Delicious, picky-eater approved meals delivered weekly.</p>
    <a href="register.php" class="btn btn-hero btn-hero-primary mt-4">Get Started with Family</a>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container py-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <h2 class="section-title-luxury mb-4">Dinner solved for the whole family</h2>
        <p class="fs-5 text-muted mb-4">Our Family Plan is designed to make weeknights easier with 18+ weekly meal options specifically crafted for families.</p>
        <ul class="list-unstyled">
          <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-3 fs-4"></i> <span class="fs-5">Pre-portioned for 4 servings</span></li>
          <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-3 fs-4"></i> <span class="fs-5">Oven-Ready options for busy nights</span></li>
          <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary me-3 fs-4"></i> <span class="fs-5">Minimal cleanup required</span></li>
        </ul>
        <a href="buyfood.php" class="btn btn-outline-primary px-5 py-3 mt-4 rounded-pill fw-bold">Explore Family Menu</a>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <img src="assets/family.png" class="w-100 rounded-5 shadow-lg" alt="Family Dinner">
      </div>
    </div>
  </div>
</section>

<section class="py-5" style="background: var(--bg-cream);">
  <div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up"><h2 class="section-title-luxury">Why families choose us</h2></div>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up">
        <div class="benefit-card">
          <div class="benefit-icon-lg"><i class="fas fa-smile-beam"></i></div>
          <h4 class="fw-bold">Picky-Eater Approved</h4>
          <p class="text-muted">Classic flavors that kids love, with gourmet touches for parents.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="benefit-card">
          <div class="benefit-icon-lg"><i class="fas fa-clock"></i></div>
          <h4 class="fw-bold">Time Back in Your Day</h4>
          <p class="text-muted">Save hours on planning and shopping with everything delivered to your door.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="benefit-card">
          <div class="benefit-icon-lg"><i class="fas fa-dollar-sign"></i></div>
          <h4 class="fw-bold">Affordable & Fresh</h4>
          <p class="text-muted">High-quality ingredients for as low as Rs. 899 per serving.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer_main.php'; ?>

</body>
</html>
