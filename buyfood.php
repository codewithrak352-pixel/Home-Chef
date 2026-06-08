<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Menu | Home Chef</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="background.css">
  <style>
    .menu-header { padding: 100px 0; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1600&auto=format') center/cover no-repeat; border-bottom: 1px solid var(--border-color); color: #fff; }
    .search-container { max-width: 600px; margin: -30px auto 40px; position: relative; z-index: 20; }
    .search-input { padding: 18px 25px 18px 55px; border-radius: 50px; border: none; box-shadow: var(--shadow-md); font-size: 1.1rem; }
    .search-icon { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 1.3rem; }
    .dietary-tag { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: var(--primary); background: var(--primary-light); padding: 2px 10px; border-radius: 4px; display: inline-block; margin-bottom: 8px; }
  </style>
</head>
<body>

<div id="preloader"><div class="preloader-logo">Home Chef</div></div>

<?php include 'header_main.php'; ?>

<section class="menu-header text-center">
  <div class="container" data-aos="fade-up">
    <h2 class="display-4 fw-bold mb-3 text-white">Our <span class="primary-text">Weekly Menu</span></h2>
    <p class="opacity-80 fs-5 text-white">Choose from our rotating selection of gourmet meal kits.</p>
  </div>
</section>

<div class="container">
  <div class="search-container" data-aos="fade-up">
    <i class="fas fa-search search-icon"></i>
    <input type="text" id="dishSearchInput" class="form-control search-input" placeholder="Search for recipes, ingredients, or cuisines...">
  </div>

  <div class="menu-filters mb-5" data-aos="fade-up">
    <div class="filter-pill active" data-category="all">All Recipes</div>
    <div class="filter-pill" data-category="Gourmet">Gourmet</div>
    <div class="filter-pill" data-category="Family">Family Plan</div>
    <div class="filter-pill" data-category="Healthy">Fresh Start</div>
    <div class="filter-pill" data-category="Vegetarian">Vegetarian</div>
    <div class="filter-pill" data-category="Asian">Asian</div>
    <div class="filter-pill" data-category="Mexican">Mexican</div>
  </div>

  <div id="dishesContainer" class="row g-4 mb-5">
    <div class="col-12 text-center py-5"><div class="spinner-border text-primary"></div></div>
  </div>
</div>

<?php include 'footer_main.php'; ?>

<script>
  let allDishes = [];
  async function fetchDishes() {
    try {
      const res = await fetch('api/dishes.php');
      const data = await res.json();
      if (data.success) {
        allDishes = data.dishes;
        renderDishes(allDishes);
      }
    } catch (e) { console.error(e); }
  }

  function renderDishes(dishes) {
    const container = document.getElementById('dishesContainer');
    if (dishes.length === 0) {
      container.innerHTML = '<div class="col-12 text-center py-5"><h3 class="text-muted">No dishes found.</h3></div>';
      return;
    }
    container.innerHTML = dishes.map((d, i) => `
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="${(i % 3) * 100}">
        <div class="luxury-card h-100">
          <a href="dish-details.php?id=${d.id}" class="text-decoration-none">
            <div class="meal-card-img-wrap">
              <img src="${d.image_url}" class="w-100 object-fit-cover" style="height: 220px;">
              <span class="meal-badge">${d.category}</span>
            </div>
          </a>
          <div class="p-4 d-flex flex-column h-100">
            <div class="dietary-tag">${d.dietary_tags}</div>
            <a href="dish-details.php?id=${d.id}" class="text-decoration-none">
              <h3 class="fw-bold h5 mb-2 text-dark">${d.name}</h3>
            </a>
            <div class="meal-meta mb-3">
              <span><i class="far fa-clock me-1"></i> ${d.prep_time}</span>
              ${d.ready_time ? `<span class="ms-2 text-primary fw-bold"><i class="fas fa-hourglass-start me-1"></i> Ready: ${d.ready_time}</span>` : `<span><i class="fas fa-fire me-1"></i> ${d.calories} Cal</span>`}
            </div>
            <p class="text-muted small mb-4 flex-grow-1">${d.description.substring(0, 120)}...</p>
            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
              <span class="fs-4 fw-bold text-dark">Rs. ${d.price}</span>
              <button class="btn btn-primary btn-sm px-4 rounded-pill order-btn" data-id="${d.id}" data-name="${d.name}" data-price="${d.price}">
                <i class="fas fa-plus me-1"></i> Add
              </button>
            </div>
          </div>
        </div>
      </div>
    `).join('');

    document.querySelectorAll('.order-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        addToCart(btn.dataset.id, btn.dataset.name, parseInt(btn.dataset.price));
      });
    });
  }

  function addToCart(id, name, price) {
    let cart = JSON.parse(localStorage.getItem("HomeChefCart")) || [];
    const existing = cart.find(i => i.id === id);
    if(existing) existing.quantity++; else cart.push({ id, name, price, quantity: 1 });
    localStorage.setItem("HomeChefCart", JSON.stringify(cart));
    showToast(`${name} added to basket!`);
  }

  function showToast(msg) {
    const toast = document.createElement('div');
    toast.style.cssText = 'position:fixed; bottom:100px; left:50%; transform:translateX(-50%); background:var(--primary); color:#fff; padding:12px 30px; border-radius:50px; z-index:10000; box-shadow:var(--shadow-lg); font-weight:700; transition:all 0.4s ease; opacity:0;';
    toast.innerText = msg;
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '1'; toast.style.bottom = '120px'; }, 100);
    setTimeout(() => { toast.style.opacity = '0'; toast.style.bottom = '100px'; setTimeout(() => toast.remove(), 400); }, 3000);
  }

  document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      const cat = pill.dataset.category;
      renderDishes(cat === 'all' ? allDishes : allDishes.filter(d => d.category === cat));
    });
  });

  document.getElementById('dishSearchInput').addEventListener('input', (e) => {
    const term = e.target.value.toLowerCase();
    renderDishes(allDishes.filter(d => d.name.toLowerCase().includes(term) || d.description.toLowerCase().includes(term)));
  });

  fetchDishes();
</script>
</body>
</html>
