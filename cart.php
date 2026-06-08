<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Basket | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .cart-card { background: #fff; border-radius: 20px; border: 1px solid var(--border-color); padding: 30px; box-shadow: var(--shadow-sm); }
    .item-row { display: flex; align-items: center; justify-content: space-between; padding: 20px 0; border-bottom: 1px solid var(--border-color); }
    .item-row:last-child { border-bottom: none; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php 
session_start();
if (isset($_SESSION['user_id'])) include 'header_dashboard.php'; 
else include 'header_main.php'; 
?>

<section class="py-5" style="background: var(--bg-cream);">
  <div class="container text-center py-4" data-aos="fade-down">
    <h2 class="display-4 fw-bold">Your <span class="primary-text">Basket</span></h2>
    <p class="text-muted">Review and customize your weekly meal selection.</p>
  </div>
</section>

<div class="container py-5 mb-5">
  <div class="row g-5">
    <div class="col-lg-8" data-aos="fade-right">
      <div class="cart-card">
        <h4 class="fw-bold mb-4">Meal Selection</h4>
        <div id="cartItemsList">
          <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4" data-aos="fade-left">
      <div class="cart-card sticky-top" style="top: 100px;">
        <h4 class="fw-bold mb-4">Summary</h4>
        <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span id="subtotalPrice">Rs. 0</span></div>
        <div class="d-flex justify-content-between mb-4"><span>Shipping</span><span class="text-success">FREE</span></div>
        <hr>
        <div class="d-flex justify-content-between mb-5"><span class="fs-4 fw-bold">Total</span><span class="fs-4 fw-bold primary-text" id="totalPrice">Rs. 0</span></div>
        <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold fs-5 shadow-lg mb-3" id="checkoutBtn">Proceed to Checkout</button>
        <a href="buyfood.php" class="btn btn-outline-secondary w-100 py-3 rounded-pill">Add More Meals</a>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];

  function renderCart() {
    const list = document.getElementById("cartItemsList");
    if(cart.length === 0) {
      list.innerHTML = '<div class="text-center py-5"><i class="fas fa-shopping-basket fs-1 text-muted mb-3 opacity-25"></i><h3 class="text-muted">Your basket is empty.</h3><a href="buyfood.php" class="btn btn-primary mt-3 px-5 rounded-pill">Start Picking Meals</a></div>';
      return;
    }
    let total = 0;
    list.innerHTML = cart.map((item, idx) => {
      const sub = item.price * (item.quantity || 1);
      total += sub;
      return `
        <div class="item-row">
          <div class="d-flex align-items-center gap-3">
            <div class="bg-light p-3 rounded-3 text-primary"><i class="fas fa-utensils fs-4"></i></div>
            <div>
              <h5 class="fw-bold mb-1">${item.name}</h5>
              <div class="small text-muted">Rs. ${item.price} per meal</div>
            </div>
          </div>
          <div class="d-flex align-items-center gap-4">
            <div class="input-group" style="width: 120px;">
              <button class="btn btn-outline-primary btn-sm rounded-start-pill px-3" onclick="updateQty(${idx}, -1)">-</button>
              <span class="form-control text-center border-primary">${item.quantity || 1}</span>
              <button class="btn btn-outline-primary btn-sm rounded-end-pill px-3" onclick="updateQty(${idx}, 1)">+</button>
            </div>
            <div class="fw-bold text-dark fs-5" style="min-width: 100px; text-align: right;">Rs. ${sub}</div>
            <button class="btn text-danger p-0 ms-2" onclick="removeItem(${idx})"><i class="fas fa-times-circle fs-4"></i></button>
          </div>
        </div>
      `;
    }).join('');
    document.getElementById("subtotalPrice").innerText = `Rs. ${total}`;
    document.getElementById("totalPrice").innerText = `Rs. ${total}`;
  }

  function updateQty(idx, delta) {
    cart[idx].quantity = (cart[idx].quantity || 1) + delta;
    if(cart[idx].quantity < 1) cart.splice(idx, 1);
    saveCart();
  }

  function removeItem(idx) {
    if(confirm("Remove this meal?")) { cart.splice(idx, 1); saveCart(); }
  }

  function saveCart() {
    localStorage.setItem("HomeChefCart", JSON.stringify(cart));
    renderCart();
  }

  document.getElementById("checkoutBtn").onclick = () => {
    if(cart.length > 0) window.location.href = "checkout.php";
  };

  renderCart();
</script>
</body>
</html>
