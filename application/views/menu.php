<body>
  <header>
    <nav class="fixed-top navbar bg-light menu-shadow">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url(); ?>" rel="noopener noreferrer">
          <img class="mb-2" src="<?php echo base_url("assets/images/logo_horizontal_probusiness_claro_2.png?ver=1.0.0"); ?>" alt="" height="45">
        </a>
        
        <button type="button" id="icon-ver-cart_shop" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#modal_cart_shop">
          <i class="fa-solid fa-bag-shopping fa-2x"></i>
          <span id="span-cart-global_cantidad" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo (isset($_SESSION['cart']) ? countBooks($_SESSION['cart']) : '0'); ?>
          </span>
        </button>
      </div>
    </nav>
  </header>

  <!-- Modal carrito de compras -->
  <div class="modal fade modal-cart_shop" id="modal_cart_shop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-cart_shop-dialog">
      <div class="modal-content modal-cart_shop-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold">Carrito de Compras</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-cart_shop-body" id="modal-cart-items">
        </div>
        <div class="modal-footer modal-cart_shop-footer fixed-bottom bg-white border border-0">
          <div class="col-12 d-grid">
            <a type="button" href="<?php echo base_url('payment'); ?>" rel="noopener noreferrer" class="btn btn-primary btn-lg">Finalizar pedido</a>
          </div>
        </div>
      </div>
    </div>
  </div>
