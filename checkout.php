<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .checkout-card { background: #fff; border-radius: 20px; padding: 40px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); }
    .payment-option { border: 2px solid var(--border-color); border-radius: 12px; padding: 20px; cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 15px; }
    .payment-option:hover, .payment-option.active { border-color: var(--primary); background: var(--primary-light); }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php 
session_start();
if (isset($_SESSION['user_id'])) include 'header_dashboard.php'; 
else include 'header_main.php'; 
?>

<div class="container py-5 mt-5">
  <div class="row g-5">
    <div class="col-lg-7" data-aos="fade-right">
      <div class="checkout-card mb-4">
        <h3 class="fw-bold mb-4 serif-font">Shipping Information</h3>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label fw-bold small">First Name</label><input type="text" id="firstName" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label fw-bold small">Last Name</label><input type="text" id="lastName" class="form-control" required></div>
          <div class="col-12"><label class="form-label fw-bold small">Street Address</label><input type="text" id="address" class="form-control" placeholder="House #, Street, Area" required></div>
          <div class="col-md-6"><label class="form-label fw-bold small">City</label><input type="text" id="city" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label fw-bold small">Phone</label><input type="text" id="phone" class="form-control" required></div>
        </div>
      </div>

      <div class="checkout-card">
        <h3 class="fw-bold mb-4 serif-font">Payment Method</h3>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="payment-option active" onclick="setPayment(this, 'cod')">
              <i class="fas fa-truck fs-3 text-primary"></i>
              <div class="fw-bold">Cash on Delivery</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="payment-option" onclick="setPayment(this, 'bank')">
              <i class="fas fa-university fs-3 text-muted"></i>
              <div class="fw-bold">Bank Transfer</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="payment-option" onclick="setPayment(this, 'card')">
              <i class="fas fa-credit-card fs-3 text-muted"></i>
              <div class="fw-bold">Credit/Debit Card</div>
            </div>
          </div>
        </div>
        <div id="bankDetails" class="mt-4 p-3 border rounded-4 bg-light d-none" style="border-style: dashed !important;">
          <p class="small mb-2 fw-bold text-primary"><i class="fas fa-info-circle me-1"></i> Select Bank for Transfer:</p>
          <select class="form-select mb-3 rounded-3" id="bankSelect" onchange="updateBankInfo()">
            <option value="hbl">HBL Bank (1234-5678-9012-3456)</option>
            <option value="mcb">MCB Bank (9876-5432-1098-7654)</option>
            <option value="ucl">UBL Bank (4567-8901-2345-6789)</option>
          </select>
          <div class="d-flex justify-content-between align-items-center">
            <span id="selectedBankInfo"><strong>HBL Bank:</strong> 1234-5678-9012-3456</span>
            <span class="badge bg-primary">Active</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5" data-aos="fade-left">
      <div class="checkout-card sticky-top" style="top: 100px;">
        <h3 class="fw-bold mb-4 serif-font">Order Review</h3>
        <img src="assets/secure.png" class="w-100 rounded-4 mb-4 shadow-sm" alt="Secure Payment">
        <div id="orderItems"></div>
        <hr class="my-4">
        <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span id="subTotal">Rs. 0</span></div>
        <div class="d-flex justify-content-between mb-2"><span>Shipping</span><span class="text-success">FREE</span></div>
        <div class="d-flex justify-content-between mb-4"><span class="fs-4 fw-bold">Total</span><span class="fs-4 fw-bold primary-text" id="orderTotal">Rs. 0</span></div>
        <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold fs-5 shadow-lg" id="placeOrderBtn">Confirm Order</button>
      </div>
    </div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
  const customerId = <?php echo $_SESSION['user_id'] ?? 'null'; ?>;
  
  if(cart.length === 0) window.location.href = "buyfood.php";
  if(!customerId) {
    alert("Please login to place an order.");
    window.location.href = "login.php";
  }

  function renderOrder() {
    const list = document.getElementById("orderItems");
    let total = 0;
    list.innerHTML = cart.map(item => {
      total += item.price * (item.quantity || 1);
      return `<div class="d-flex justify-content-between mb-2 small text-muted"><span>${item.name} x${item.quantity || 1}</span><span>Rs. ${item.price * (item.quantity || 1)}</span></div>`;
    }).join('');
    document.getElementById("subTotal").innerText = `Rs. ${total}`;
    document.getElementById("orderTotal").innerText = `Rs. ${total}`;
  }

  function setPayment(el, type) {
    document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
    el.classList.add('active');
    const bankDetails = document.getElementById('bankDetails');
    if (type === 'bank') bankDetails.classList.remove('d-none');
    else bankDetails.classList.add('d-none');
    
    if (type === 'card') alert("Credit Card payment gateway is being initialized. You can proceed with the order, and we will contact you for card details.");
  }

  document.getElementById("placeOrderBtn").onclick = async () => {
    const address = document.getElementById("address").value;
    const city = document.getElementById("city").value;
    const phone = document.getElementById("phone").value;
    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;

    if(!address || !city || !phone || !firstName) {
      alert("Please fill in all shipping details.");
      return;
    }

    const fullAddress = `${address}, ${city} (Phone: ${phone}, Name: ${firstName} ${lastName})`;
    let total = 0;
    cart.forEach(item => total += item.price * (item.quantity || 1));

    const btn = document.getElementById("placeOrderBtn");
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

    try {
      const response = await fetch('api/orders.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          customerId: customerId,
          cart: cart,
          totalAmount: total,
          address: fullAddress
        })
      });

      const result = await response.json();
      if (result.success) {
        localStorage.removeItem("HomeChefCart");
        window.location.href = "order-success.php?orderId=" + result.orderId + "&total=" + result.totalAmount;
      } else {
        alert("Error: " + result.message);
        btn.disabled = false;
        btn.innerHTML = 'Confirm Order';
      }
    } catch (error) {
      console.error(error);
      alert("An error occurred. Please try again.");
      btn.disabled = false;
      btn.innerHTML = 'Confirm Order';
    }
  };

  renderOrder();
</script>
</body>
</html>
