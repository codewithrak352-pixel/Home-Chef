<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gift Cards | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .gift-hero { height: 400px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('assets/giftcard.png') center/cover no-repeat; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; }
    .card-type-btn { background: #fff; border: 1px solid var(--border-color); padding: 30px; border-radius: 16px; box-shadow: var(--shadow-md); cursor: pointer; transition: var(--transition); text-align: center; width: 100%; }
    .card-type-btn.active { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
    .amount-btn { border: 1px solid var(--border-color); background: #fff; padding: 15px; border-radius: 8px; font-weight: 700; transition: var(--transition); width: 100%; }
    .amount-btn.active { background: var(--primary); color: #fff; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="gift-hero"><div class="container" data-aos="fade-up"><h2>The Gift That Keeps On Cooking</h2></div></section>

<div class="container mb-5 mt-5">
  <div class="row g-4 justify-content-center" data-aos="fade-up">
    <div class="col-md-3"><div class="card-type-btn active">Digital Card</div></div>
    <div class="col-md-3"><div class="card-type-btn">Physical Card</div></div>
  </div>

  <div class="row g-5 mt-4">
    <div class="col-lg-7" data-aos="fade-right">
      <div class="p-4 bg-white border rounded-4">
        <h3 class="serif-font fw-bold mb-4">Choose an Amount</h3>
        <div class="row g-3">
          <div class="col-4"><button class="amount-btn active">Rs. 2500</button></div>
          <div class="col-4"><button class="amount-btn">Rs. 5000</button></div>
          <div class="col-4"><button class="amount-btn">Rs. 10000</button></div>
        </div>
        <h3 class="serif-font fw-bold mt-5 mb-4">Personalize</h3>
        <input type="text" class="form-control mb-3" placeholder="Recipient Name">
        <input type="email" class="form-control mb-3" placeholder="Recipient Email">
        <textarea class="form-control mb-4" rows="4" placeholder="Personal Message"></textarea>
        <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold">Purchase Gift Card</button>
      </div>
    </div>
    <div class="col-lg-5" data-aos="fade-left">
      <div class="p-4 bg-white border rounded-4">
        <h4 class="fw-bold mb-4">How it works</h4>
        <img src="assets/giftcard.png" class="w-100 rounded-4 mb-4 shadow-sm" alt="Gift Card Mockup">
        <p class="text-muted">Choose a value, add a personal touch, and we'll deliver it instantly via email or mail. Redeeming is easy at checkout!</p>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

</body>
</html>
