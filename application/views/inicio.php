<html lang="en" data-bs-theme="dark">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon/favicon.ico?ver=5.0"); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="192x192" href="<?php echo base_url("assets/images/favicon/android-chrome-512x512.png?ver=5.0"); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="192x192" href="<?php echo base_url("assets/images/favicon/android-chrome-192x192.png?ver=5.0"); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="32x32" href="<?php echo base_url("assets/images/favicon/favicon-32x32.png?ver=5.0"); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="16x16" href="<?php echo base_url("assets/images/favicon/favicon-16x16.png?ver=5.0"); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="16x16" href="<?php echo base_url("assets/images/favicon/apple-touch-icon.png?ver=5.0"); ?>">
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon/favicon.png?ver=5.0.0"); ?>" type="image/png">
	  <link rel="icon" href="<?php echo base_url("assets/images/favicon/favicon.png?ver=5.0.0"); ?>" type="image/png">
    
    <title>ProBusiness | Importación Grupal</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css?ver=1.0.0'; ?>">

    <meta name="theme-color" content="#FF6700">
		<meta name="msapplication-navbutton-color" content="#FF6700"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="msapplication-navbutton-color" content="#FF6700" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  </head>
  <body>
    <header>
      <nav class="fixed-top navbar bg-light menu-shadow">
        <div class="container-fluid">
          <a class="navbar-brand">
            <img class="mb-2" src="<?php echo base_url("assets/images/logo_horizontal_probusiness_claro_2.png?ver=1.0.0"); ?>" alt="" height="45">
          </a>
          
          <a class="menu-ul-a send-order text-decoration-none" onclick="modalpedido()" style="">
            <span style="" class="count-car-global">
              <p class="text-black gradiente-btn gradiente-btn-menu" style="">
                <i class="fa-solid fa-bag-shopping fa-2x"></i>
                <span style="" class="h5"><?php echo 1; ?></span>
              </p>
            </span>
          </a>
        </div>
      </nav>
    </header>

    <main>
      <div id="carouselExampleDark" class="carousel carousel-dark slide mt-5 mt-md-0">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="<?php echo base_url("assets/images/portada_login.jpg?ver=1.0.0"); ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="<?php echo base_url("assets/images/portada_login.jpg?ver=1.0.0"); ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?php echo base_url("assets/images/portada_login.jpg?ver=1.0.0"); ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="container mt-5">
        <?php
        if ($arrImportacionGrupalProducto['status'] == 'success') {
          $arrImportacionGrupalProducto = $arrImportacionGrupalProducto['result'];
        ?>
          <h1 class="text-center"><?php echo $arrImportacionGrupalProducto[0]->No_Importacion_Grupal; ?></h1>
          <p class="text-center lead mb-5">
            Fecha de Inicio: <?php echo ToDateBD($arrImportacionGrupalProducto[0]->Fe_Inicio); ?> y
            Fecha de Cierre: <?php echo ToDateBD($arrImportacionGrupalProducto[0]->Fe_Fin); ?>
          </p>

          <!-- diseño de item -->
          <?php foreach ($arrImportacionGrupalProducto as $row) { ?>
          <div class="card mt-5">
            <div class="row g-0">
              <div class="col-sm-4 position-relative">
                <img src="<?php echo base_url("assets/images/elefante.png?ver=1.0.0"); ?>" class="card-img fit-cover w-100 cart-size-img" alt="<?php echo $row->No_Producto; ?>">
              </div>

              <div class="col-sm-8">
                <div class="card-body">
                  <h2 class="card-title mb-3">
                    <a class="link-dark text-decoration-none" href="#" target="_blank">
                      <?php echo $row->No_Producto; ?>
                    </a>
                  </h2>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Unidad</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">C/U</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $row->No_Unidad_Medida; ?></td>
                        <td><?php echo $row->cantidad_item; ?></td>
                        <td><?php echo $row->No_Signo . ' ' . $row->precio_item; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $row->No_Unidad_Medida_2; ?></td>
                        <td><?php echo $row->cantidad_item_2; ?></td>
                        <td><?php echo $row->No_Signo . ' ' . $row->precio_item_2; ?></td>
                      </tr>
                    </tbody>
                  </table>

                  <p class="card-text">
                    <?php echo $row->Txt_Producto; ?>
                  </p>
                  <span><strong>Vendidos</strong></span>
                  <div class="progress" style="height: 35px;">
                    <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: 80%;" aria-valuenow="200" aria-valuemin="0" aria-valuemax="100"><span class="text-black"><strong>200/240</strong></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- fin de diseño de item -->
          <?php } ?>
        <?php } else { ?>
          <h5 class="text-center"><?php echo $arrImportacionGrupalProducto['message']; ?></h5>
        <?php } ?>
      </div>
    </main>

    <div class="container py-3">
      <footer class="pt-4 my-md-5 pt-md-5 pb-4 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="<?php echo base_url("assets/images/isotipo_probusiness.png?ver=1.0.0"); ?>" alt="" height="45">
            <small class="d-block mb-3 text-body-secondary">© 2017–<?php echo date('Y'); ?></small>
          </div>
          <div class="col-6 col-md">
            <h5>Empresa</h5>
            <ul class="list-unstyled text-small">
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Nosotros</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Política de Privacidad</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Términos y condiciones</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Redes Sociales</h5>
            <ul class="list-unstyled text-small">
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="https://www.tiktok.com/@pro_business_impo" alt="ProBusiness" title="ProBusiness" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-tiktok"></i> Tiktok</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="https://www.instagram.com/probusinesspe/" alt="ProBusiness" title="ProBusiness" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="https://www.facebook.com/Probusinesspe" alt="ProBusiness" title="ProBusiness" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="https://www.youtube.com/@MiguelVillegasImportaciones" alt="ProBusiness" title="ProBusiness" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i> Youtube</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Contacto</h5>
            <ul class="list-unstyled text-small">
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="fa-solid fa-phone"></i> (+51) 953 314 683</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="fa-solid fa-envelope"></i> cursodeimpo@gmail.com</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="fa-solid fa-map-pin"></i> Alberto Barton 527 - La Victoria - Perú</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
 
    <div class="fixed-bottom mt-auto py-3 bg-white footer-cart-shadow">
      <div class="container">
        <div class="row">
          <div class="col-5 col-sm-6">
            <div id="div-cart_items">4 productos</div>
            <div id="div-cart_total" class="fw-bold fs-5">S/ 200.00</div>
          </div>
          <div class="col-7 col-sm-6">
            <div id="div-cart_total" class="d-grid">
              <button class="btn btn-primary me-md-2 btn-lg" type="button">Ver mi pedido</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b7119ee4cd.js" crossorigin="anonymous"></script>
  </body>
</html>
