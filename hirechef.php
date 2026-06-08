<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hire a Chef | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .chef-hero {
      height: 400px;
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1600&auto=format') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }
    .chef-card {
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid var(--border-color);
      transition: var(--transition);
      height: 100%;
    }
    .chef-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-lg);
    }
    .chef-img {
      height: 350px;
      object-fit: cover;
      width: 100%;
    }
    .chef-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      background: var(--primary);
      color: #fff;
      padding: 5px 15px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 0.8rem;
    }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="chef-hero">
  <div class="container" data-aos="fade-up">
    <h2 class="display-3 fw-bold">Hire a Professional Chef</h2>
    <p class="fs-4 opacity-90">Expert culinary masters for your home events and private dining.</p>
  </div>
</section>

<div class="container py-5 my-5">
  <div class="text-center mb-5" data-aos="fade-up">
    <h2 class="section-title-luxury">Our Featured Chefs</h2>
    <p class="text-muted">Verified professionals ready to bring the gourmet experience to you.</p>
  </div>

  <div class="row g-4">
    <!-- Chef 1: AQIB RAJPOOT -->
    <div class="col-md-6" data-aos="fade-right">
      <div class="chef-card position-relative">
        <span class="chef-badge">Executive Chef</span>
        <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=800" class="chef-img" alt="AQIB RAJPOOT">
        <div class="p-4 text-center">
          <h3 class="fw-bold serif-font mb-2">AQIB RAJPOOT</h3>
          <p class="text-muted mb-4">Specialist in Continental and Pakistani Fusion cuisine. 10+ years of experience in luxury dining.</p>
          <div class="fs-4 fw-bold text-primary mb-4">Rs. 5,000 <small class="text-muted">/ event</small></div>
          <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold" onclick="bookChef('AQIB RAJPOOT', 5000)">Book AQIB RAJPOOT</button>
        </div>
      </div>
    </div>

    <!-- Chef 2: Hassan Murtaza -->
    <div class="col-md-6" data-aos="fade-left">
      <div class="chef-card position-relative">
        <span class="chef-badge">Traditional Expert</span>
        <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548?w=800" class="chef-img" alt="Hassan Murtaza">
        <div class="p-4 text-center">
          <h3 class="fw-bold serif-font mb-2">Hassan Murtaza</h3>
          <p class="text-muted mb-4">Master of traditional South Asian feasts. Expert in Biryani, Karahi, and festive catering.</p>
          <div class="fs-4 fw-bold text-primary mb-4">Rs. 3,500 <small class="text-muted">/ event</small></div>
          <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold" onclick="bookChef('Hassan Murtaza', 3500)">Book Hassan Murtaza</button>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5 p-5 rounded-5 bg-white border shadow-sm" data-aos="zoom-in">
    <div class="row align-items-center text-center text-lg-start">
      <div class="col-lg-8">
        <h3 class="serif-font fw-bold mb-3">Hosting a large party?</h3>
        <p class="text-muted mb-0">Our chefs can handle events for up to 50 guests. Contact us for custom menu planning and event support.</p>
      </div>
      <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
        <a href="mailto:chef@homechef.com" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">Contact Support</a>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  function bookChef(name, price) {
    let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    cart.push({ name: `Private Session: ${name}`, price: price, quantity: 1, type: 'chef' });
    localStorage.setItem("HomeChefCart", JSON.stringify(cart));
    alert(`Request sent for ${name}! Added to your basket.`);
    window.location.href = "cart.php";
  }
</script>

</body>
</html>
