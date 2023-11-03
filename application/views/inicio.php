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

      <input type="hidden" id="hidden-global-signo_moneda" class="form-control" value="<?php echo $arrImportacionGrupalProducto[0]->No_Signo; ?>">

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
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">C/U</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $row->No_Unidad_Medida; ?></td>
                    <td><?php echo $row->cantidad_item; ?></td>
                    <td><?php echo $row->No_Signo . ' ' . $row->precio_item; ?></td>
                    <td>
                      <div id="div-agregar_item-<?php echo $row->ID_Producto; ?>" class="d-grid">
                        <button id="btn-agregar_item-<?php echo $row->ID_Producto; ?>" data-id_unidad_medida_2="" data-id_unidad_medida="<?php echo $row->ID_Unidad_Medida; ?>" data-id_item_bd="<?php echo $row->ID_Producto; ?>" data-id_item="<?php echo $row->ID_Producto . $row->ID_Unidad_Medida; ?>" data-cantidad_item="<?php echo $row->cantidad_item; ?>" data-precio_item="<?php echo $row->precio_item; ?>" data-nombre_item="<?php echo $row->No_Producto; ?>" data-url_imagen_item="<?php echo base_url("assets/images/elefante.png?ver=1.0.0"); ?>" class="btn btn-primary btn-lg btn-agregar_item" type="button">Agregar</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo $row->No_Unidad_Medida_2; ?></td>
                    <td><?php echo $row->cantidad_item_2; ?></td>
                    <td><?php echo $row->No_Signo . ' ' . $row->precio_item_2; ?></td>
                    <td>
                      <div id="div-agregar_item-<?php echo $row->ID_Producto; ?>" class="d-grid">
                        <button id="btn-agregar_item-<?php echo $row->ID_Producto; ?>" data-id_unidad_medida="" data-id_unidad_medida_2="<?php echo $row->ID_Unidad_Medida_2; ?>" data-id_item_bd="<?php echo $row->ID_Producto; ?>" data-id_item="<?php echo $row->ID_Producto . $row->ID_Unidad_Medida_2; ?>" data-cantidad_item="<?php echo $row->cantidad_item_2; ?>" data-precio_item="<?php echo $row->precio_item_2; ?>" data-nombre_item="<?php echo $row->No_Producto; ?>" data-url_imagen_item="<?php echo base_url("assets/images/elefante.png?ver=1.0.0"); ?>" class="btn btn-primary btn-lg btn-agregar_item" type="button">Agregar</button>
                      </div>
                    </td>
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

<div id="div-footer-cart" class="fixed-bottom mt-auto py-3 bg-white footer-cart-shadow" data-bs-toggle="modal" data-bs-target="#modal_cart_shop">
  <div class="container">
    <div class="row">
      <div class="col-5 col-sm-6">
        <div id="div-cart_items"></div>
        <div id="div-cart_total" class="fw-bold fs-5"></div>
      </div>
      <div class="col-7 col-sm-6">
        <div class="d-grid">
          <button id="btn-ver-cart_shop" class="btn btn-primary me-md-2 btn-lg" type="button">Ver mi pedido</button>
        </div>
      </div>
    </div>
  </div>
</div>