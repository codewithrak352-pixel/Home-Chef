<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Chef | Manage Dishes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <script>
    const userAuth = JSON.parse(localStorage.getItem('currentUser'));
    if (!userAuth || !userAuth.loggedIn || userAuth.role !== 'seller') {
      window.location.href = 'login.php';
    }
  </script>
</head>
<body class="d-flex flex-column">
<header>
  <h1>Manage Menu</h1>
  <button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
  </button>
  <nav>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
    <a href="newdish.php"><i class="fas fa-plus-circle me-1"></i> Add New</a>
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
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="newdish.php"><i class="fas fa-plus-circle me-2"></i> Add New</a>
  </nav>
</div>
<section class="page-hero">
  <h2>Your <span class="primary-text">Culinary Creations</span></h2>
  <p><i class="fas fa-utensils me-2 primary-text"></i> Update or remove items from your public menu</p>
</section>

<div class="container py-5">
  <div id="dishesGrid" class="row g-4">
    
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header bg-dark text-primary border-0 rounded-top-4">
        <h5 class="modal-title fw-bold">Edit Dish</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form id="editForm">
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label class="small fw-bold text-muted">DISH NAME</label>
            <input type="text" id="editName" class="form-control rounded-pill" required>
          </div>
          <div class="mb-3">
            <label class="small fw-bold text-muted">DESCRIPTION</label>
            <textarea id="editDesc" class="form-control rounded-4" rows="3" required></textarea>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="small fw-bold text-muted">PRICE (Rs.)</label>
              <input type="number" id="editPrice" class="form-control rounded-pill" required>
            </div>
            <div class="col-6">
              <label class="small fw-bold text-muted">CATEGORY</label>
              <select id="editCategory" class="form-select rounded-pill">
                <option value="gourmet">Gourmet</option>
                <option value="traditional">Traditional</option>
                <option value="healthy">Healthy</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="small fw-bold text-muted">STATUS</label>
            <select id="editStatus" class="form-select rounded-pill">
              <option value="available">Available</option>
              <option value="out_of_stock">Out of Stock</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 mt-3">SAVE CHANGES</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
  const user = JSON.parse(localStorage.getItem('currentUser'));
  const editModal = new bootstrap.Modal(document.getElementById('editModal'));
  let myDishes = [];

  async function fetchMyDishes() {
    try {
      const response = await fetch(`api/dishes.php?sellerId=${user.id}`);
      const result = await response.json();
      if (result.success) {
        myDishes = result.dishes;
        renderDishes();
      }
    } catch (e) { console.error(e); }
  }

  function renderDishes() {
    const grid = document.getElementById('dishesGrid');
    if (myDishes.length === 0) {
      grid.innerHTML = '<div class="col-12 text-center py-5"><p class="text-muted">You haven\'t added any dishes yet.</p><a href="newdish.php" class="btn btn-primary rounded-pill">Add Your First Dish</a></div>';
      return;
    }
    grid.innerHTML = myDishes.map(d => `
      <div class="col-md-6 col-lg-4" data-aos="fade-up">
        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
          <img src="${d.image_url || 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&auto=format&fit=crop'}" class="card-img-top" style="height: 180px; object-fit: cover;">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between mb-2">
              <h5 class="fw-bold mb-0">${d.name}</h5>
              <span class="badge ${d.status === 'available' ? 'bg-success' : 'bg-danger'} rounded-pill">${d.status}</span>
            </div>
            <p class="text-muted small mb-3 text-truncate">${d.description}</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold primary-text fs-5">Rs. ${d.price}</span>
              <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="openEdit(${d.id})">Edit</button>
                <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="deleteDish(${d.id})"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    `).join('');
  }

  function openEdit(id) {
    const dish = myDishes.find(d => d.id == id);
    if (!dish) return;
    document.getElementById('editId').value = dish.id;
    document.getElementById('editName').value = dish.name;
    document.getElementById('editDesc').value = dish.description;
    document.getElementById('editPrice').value = dish.price;
    document.getElementById('editCategory').value = dish.category;
    document.getElementById('editStatus').value = dish.status;
    editModal.show();
  }

  document.getElementById('editForm').onsubmit = async (e) => {
    e.preventDefault();
    const data = {
      id: document.getElementById('editId').value,
      name: document.getElementById('editName').value,
      description: document.getElementById('editDesc').value,
      price: document.getElementById('editPrice').value,
      category: document.getElementById('editCategory').value,
      status: document.getElementById('editStatus').value
    };
    try {
      const response = await fetch('api/dishes.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      const result = await response.json();
      if (result.success) {
        editModal.hide();
        fetchMyDishes();
        showNotification("Dish updated successfully!");
      }
    } catch (e) { console.error(e); }
  };

  async function deleteDish(id) {
    if (!confirm("Are you sure you want to delete this dish?")) return;
    try {
      const response = await fetch('api/dishes.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const result = await response.json();
      if (result.success) {
        fetchMyDishes();
        showNotification("Dish deleted successfully!");
      }
    } catch (e) { console.error(e); }
  }

  function showNotification(msg) {
    const div = document.createElement('div');
    div.className = 'custom-alert';
    div.style.background = '#2ecc71';
    div.style.color = '#fff';
    div.innerHTML = `<i class="fas fa-check-circle me-2"></i> ${msg}`;
    document.body.appendChild(div);
    setTimeout(() => { div.style.opacity = '0'; setTimeout(() => div.remove(), 400); }, 3000);
  }

  fetchMyDishes();
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
  }

  initMobileMenu();
</script>
</body>
</html>
