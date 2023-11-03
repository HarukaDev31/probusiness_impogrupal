<main><br><br>
  <div class="container mt-5">
    <h2 class="text-center mb-4 text-success"><i class="fa-solid fa-circle-check fa-3x text-green"></i></h2>
    <h2 class="text-center mb-4 fw-bold">Pedido creado</h2>
    
    <div class="col-12 col-sm-12 col-md-12">
      <h2 class="text-left mb-4 fw-bold">Resumen</h2>
        <div class="card" style="border: none;">
        <div class="card-body shadow p-3 bg-body rounded pt-0">
          <?php //aqui borrar session carrito ?>
          <?php
          $fTotalCantidadPedido = 0;
          $fTotalImportePedido = 0;
          foreach($arrPedido as $row){
            $fTotalCantidadPedido = $row['cantidad_item'];
            $fTotalImportePedido = $row['total_item'];
          ?>
          <div class="row div-line">
            <div class="col-12">
              <div class="modal-cart_shop-div_item" id="delete_item_562260">
                <a href="#" class="modal-cart_shop-img_item">
                  <img src="<?php echo $row['url_imagen_item']; ?>">
                </a>
                <div class="modal-cart_shop-body_item">
                  <h6 class="ps-2"><?php echo $row['nombre_item']; ?></h6>
                  <div class="modal-cart_shop-div-precio_item ps-2">
                    <span class="fw-bold">
                      Cant: <span data-total_producto="80" id="total-por-producto_562260"><?php echo $row['cantidad_item']; ?></span>
                    </span>

                    <span class="fw-bold float-right">
                      S/ <span data-total_producto="80" id="total-por-producto_562260"><?php echo $row['total_item']; ?></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          
          <div class="col-12 d-grid mt-3">
            <div class="modal-cart_shop-div-precio_item pb-3">
              <span class="fw-bold">
                Total
              </span>

              <span class="fw-bold float-right">
                <input type="hidden" id="hidden-cart_shop-cantidad_total" class="form-control" value="<?php echo $fTotalCantidadPedido; ?>">
                <input type="hidden" id="hidden-cart_shop-importe_total" class="form-control" value="<?php echo $fTotalImportePedido; ?>">
                S/ <span><?php echo $fTotalImportePedido; ?></span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>