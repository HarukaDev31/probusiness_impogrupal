<main><br><br>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 col-md-8">
        <div class="col-12 col-sm-12 col-md-12">
          <h2 class="text-left mb-3 fw-bold">Información de contacto</h2>
          <form>
            <div class="card" style="border: none;">
              <div class="card-body shadow p-3 bg-body rounded">
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>DNI / RUC / OTROS <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" id="payment-documento_identidad" inputmode="numeric" name="Nu_Documento_Identidad" class="form-control required input-number" placeholder="Ingresar" maxlength="15" autocomplete="on">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>Nombres y Apellidos <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" inputmode="text" id="payment-nombre_cliente" name="No_Entidad" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="on">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>Celular <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" inputmode="tel" id="payment-celular_cliente" name="Nu_Celular_Entidad" class="form-control required input-number" placeholder="Ingresar" maxlength="9" autocomplete="on">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>Email <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" id="payment-email" inputmode="text" name="Txt_Email_Entidad" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="on">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        
        <div class="col-12 col-sm-12 col-md-12">
          <!--direccion-->
          <h2 class="text-left mb-3 fw-bold">Dirección</h2>
          <form>
            <div class="card" style="border: none;">
              <div class="card-body shadow p-3 mb-5 bg-body rounded">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 mb-3">
                    <label>Dirección <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" id="payment-direccion" inputmode="text" name="Txt_Direccion" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="off">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <div class="col-12 col-sm-4 col-md-4">
        <div class="col-12 col-sm-12 col-md-12">
          <h2 class="text-center mb-3 fw-bold">Resumen</h2>
            <div class="card" style="border: none;">
            <div class="card-body shadow p-3 bg-body rounded pt-0">
              <?php //array_debug($_SESSION['cart']); ?>
              <?php
              $fTotalCantidadPedido = 0;
              $fTotalImportePedido = 0;
              foreach($_SESSION['cart'] as $row){
                $fTotalCantidadPedido += $row['cantidad_item'];
                $fTotalImportePedido += $row['total_item'];
              ?>
              <div class="row div-line">
                <div class="col-12">
                  <div class="modal-cart_shop-div_item" id="delete_item_562260">
                    <a href="#" class="modal-cart_shop-img_item">
                      <img class="shadow-sm bg-body rounded" src="<?php echo $row['url_imagen_item']; ?>">
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

              <div class="col-12 d-grid">
                <div class="modal-cart_shop-div-precio_item pb-3">
                  <span class="fw-bold text-danger fs-5">
                    Total a pagar
                  </span>

                  <span class="fw-bold float-right text-danger fs-5">
                    <input type="hidden" id="hidden-cart_shop-cantidad_total" class="form-control" value="<?php echo $fTotalCantidadPedido; ?>">
                    <input type="hidden" id="hidden-cart_shop-importe_total" class="form-control" value="<?php echo $fTotalImportePedido; ?>">
                    S/ <span><?php echo round(($fTotalImportePedido / 2), 2); ?></span>
                  </span>
                </div>
              </div>
              <div class="col-12 d-grid">
                <button type="button" id="btn-completar_pedido" class="btn btn-primary btn-lg">Completar pedido</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>