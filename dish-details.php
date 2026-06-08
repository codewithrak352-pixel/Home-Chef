<?php
require_once 'config/db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT d.*, u.fullName as chef_name FROM dishes d JOIN users u ON d.seller_id = u.id WHERE d.id = ?");
$stmt->execute([$id]);
$dish = $stmt->fetch();
if (!$dish) { header('Location: buyfood.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $dish['name']; ?> | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .dish-hero { height: 400px; background: url('<?php echo $dish['image_url']; ?>') center/cover no-repeat; position: relative; }
    .dish-hero::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); }
    .dish-header-content { position: absolute; bottom: 40px; left: 5%; color: #fff; z-index: 10; }
    .nutrition-box { background: #fff; border: 1px solid var(--border-color); border-radius: 16px; padding: 30px; box-shadow: var(--shadow-md); }
    .nutrition-item { text-align: center; padding: 10px; }
    .nutrition-value { font-size: 1.5rem; font-weight: 800; color: var(--primary); display: block; }
    .nutrition-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="dish-hero">
  <div class="dish-header-content" data-aos="fade-up">
    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3"><?php echo $dish['category']; ?></span>
    <h2 class="display-4 fw-bold serif-font"><?php echo $dish['name']; ?></h2>
    <div class="d-flex gap-4 mt-3">
      <span><i class="far fa-clock me-2"></i> <?php echo $dish['prep_time']; ?></span>
      <span><i class="fas fa-fire me-2"></i> <?php echo $dish['calories']; ?> Cal</span>
    </div>
  </div>
</section>

<div class="container my-5">
  <div class="row g-5">
    <div class="col-lg-8" data-aos="fade-right">
      <h3 class="fw-bold mb-4 serif-font">About this dish</h3>
      <p class="fs-5 text-muted"><?php echo $dish['description']; ?></p>
      <div class="mt-5 p-4 bg-light rounded-4 border-start border-4 border-primary">
        "Enjoy this chef-curated recipe with fresh ingredients delivered to your door."<br><br>
        <span class="fw-bold">— Chef <?php echo $dish['chef_name']; ?></span>
      </div>
    </div>
    <div class="col-lg-4" data-aos="fade-left">
      <div class="nutrition-box sticky-top" style="top: 100px;">
        <h4 class="fw-bold mb-4 text-center">Nutrition Facts</h4>
        <div class="row g-0 border-bottom mb-3">
          <div class="col-6 nutrition-item border-end"><span class="nutrition-value"><?php echo $dish['protein']; ?>g</span><span class="nutrition-label">Protein</span></div>
          <div class="col-6 nutrition-item"><span class="nutrition-value"><?php echo $dish['fat']; ?>g</span><span class="nutrition-label">Fat</span></div>
        </div>
        <div class="row g-0 mb-4">
          <div class="col-6 nutrition-item border-end"><span class="nutrition-value"><?php echo $dish['carbs']; ?>g</span><span class="nutrition-label">Carbs</span></div>
          <div class="col-6 nutrition-item"><span class="nutrition-value"><?php echo $dish['calories']; ?></span><span class="nutrition-label">Calories</span></div>
        </div>
        <div class="text-center pt-4 border-top">
          <div class="fs-2 fw-bold text-dark mb-4">Rs. <?php echo $dish['price']; ?></div>
          <button class="btn btn-primary w-100 py-3 rounded-pill fs-5" onclick="addToCart('<?php echo addslashes($dish['name']); ?>', <?php echo $dish['price']; ?>)">Add to Box</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  function addToCart(name, price) {
    let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    const existing = cart.find(i => i.name === name);
    if(existing) existing.quantity++; else cart.push({ name, price, quantity: 1 });
    localStorage.setItem("HomeChefCart", JSON.stringify(cart));
    alert(`${name} added to box!`);
  }
</script>
</body>
</html>
