<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Become a Chef | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    body { background: var(--bg-soft); }
    .upload-card { background: #fff; border-radius: 30px; border: 1px solid var(--border-color); padding: 50px; box-shadow: var(--shadow-lg); max-width: 900px; margin: auto; }
    .form-label { font-weight: 700; color: var(--text-dark); text-transform: uppercase; font-size: 0.8rem; margin-bottom: 10px; }
    .image-dropzone { border: 2px dashed var(--primary-light); border-radius: 20px; padding: 40px; text-align: center; background: var(--bg-cream); transition: var(--transition); cursor: pointer; }
    .image-dropzone:hover { border-color: var(--primary); background: #fff; }
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
  <div class="container text-center py-5" data-aos="fade-down">
    <h2 class="display-4 fw-bold">Share Your <span class="primary-text">Culinary Passion</span></h2>
    <p class="text-muted fs-5">Upload your signature dish and start serving your community today.</p>
  </div>
</section>

<div class="container py-5 mb-5">
  <div class="upload-card" data-aos="fade-up">
    <form id="uploadDishForm" class="row g-4">
      <div class="col-md-6">
        <label class="form-label">Dish Name</label>
        <input type="text" id="dishName" class="form-control form-control-lg rounded-pill px-4" placeholder="e.g. Grandma's Secret Biryani" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Category</label>
        <select id="dishCategory" class="form-select form-select-lg rounded-pill px-4" required>
          <option value="Gourmet">Gourmet</option>
          <option value="Family">Family Size</option>
          <option value="Healthy">Healthy / Fresh Start</option>
          <option value="Vegetarian">Vegetarian</option>
          <option value="Asian">Asian Fusion</option>
        </select>
      </div>
      <div class="col-12">
        <label class="form-label">Description</label>
        <textarea id="dishDesc" class="form-control rounded-4 p-4" rows="4" placeholder="Tell us about the ingredients, flavors, and history of this dish..." required></textarea>
      </div>
      <div class="col-md-4">
        <label class="form-label">Price (Rs.)</label>
        <input type="number" id="dishPrice" class="form-control form-control-lg rounded-pill px-4" placeholder="e.g. 1250" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Preparation Time</label>
        <input type="text" id="prepTime" class="form-control form-control-lg rounded-pill px-4" placeholder="e.g. 30-40 min" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Ready By Time</label>
        <input type="time" id="readyTime" class="form-control form-control-lg rounded-pill px-4" required>
      </div>
      
      <div class="col-12 mt-5">
        <label class="form-label d-block text-center mb-4">Dish Portrait</label>
        <div class="image-dropzone" onclick="document.getElementById('dishImage').click()">
          <i class="fas fa-cloud-upload-alt fs-1 text-primary mb-3"></i>
          <p class="mb-0 text-muted">Click to upload or drag and drop a high-quality photo</p>
          <input type="file" id="dishImage" class="d-none" accept="image/*" onchange="previewImage(event)">
          <div id="previewContainer" class="mt-4 d-none">
            <img id="dishPreview" src="https://images.unsplash.com/photo-1495195129352-aeb325a55b65?w=400&auto=format" class="rounded-4 shadow-md w-100" style="max-height: 250px; object-fit: cover;">
          </div>
        </div>
      </div>

      <div class="col-12 mt-5 text-center">
        <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold fs-5 shadow-lg">List My Dish Now</button>
      </div>
    </form>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      const preview = document.getElementById('dishPreview');
      preview.src = reader.result;
      document.getElementById('previewContainer').classList.remove('d-none');
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  document.getElementById('uploadDishForm').onsubmit = async function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('dishName', document.getElementById('dishName').value);
    formData.append('dishCategory', document.getElementById('dishCategory').value);
    formData.append('dishDesc', document.getElementById('dishDesc').value);
    formData.append('dishPrice', document.getElementById('dishPrice').value);
    formData.append('prepTime', document.getElementById('prepTime').value);
    formData.append('readyTime', document.getElementById('readyTime').value);
    
    const dishImage = document.getElementById('dishImage').files[0];
    if (dishImage) formData.append('dishImage', dishImage);

    try {
      const res = await fetch('api/dishes.php', { method: 'POST', body: formData });
      const result = await res.json();
      if (result.success) {
        alert("✨ Your dish has been successfully listed!");
        window.location.href = "buyfood.php";
      } else {
        alert("Error: " + result.message);
      }
    } catch (err) {
      console.error(err);
      alert("Something went wrong. Please try again.");
    }
  }
</script>

</body>
</html>
