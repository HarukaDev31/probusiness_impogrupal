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
                      <input type="text" inputmode="text" id="payment-nombre_cliente" name="name" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="name">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>Celular <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="tel" inputmode="tel" id="payment-celular_cliente" name="tel" class="form-control required input-number" placeholder="Ingresar" maxlength="9" autocomplete="tel">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label>Email <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" id="payment-email" inputmode="email" name="email" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="email" autocapitalize="none">
                      <span class="help-block text-danger" id="error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <?php
        //array_debug($arrDepartamento);
        //array_debug($arrProvincia);
        //array_debug($arrDistrito);
        ?>

        <div class="col-12 col-sm-12 col-md-12">
          <!--direccion-->
          <h2 class="text-left mb-3 fw-bold">Dirección</h2>
          <form>
            <div class="card" style="border: none;">
              <div class="card-body shadow p-3 bg-body rounded">
                <div class="row">
                  <div class="col-12 col-sm-4 col-md-4 mb-3">
                    <label>Departamento <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <select name="cbo-departamento" id="cbo-departamento" class="form-select">
                        <option value="0" selected="selected">- Seleccionar -</option>
                        <?php foreach ($arrDepartamento['result'] as $row) { ?>
                          <option value="<?php echo $row->ID_Departamento; ?>"><?php echo $row->No_Departamento; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <span class="help-block text-danger" id="error"></span>
                  </div>
                  
                  <div class="col-12 col-sm-4 col-md-4 mb-3">
                    <label>Provincia <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <select name="cbo-provincia" id="cbo-provincia" class="form-select">
                        <option value="0" selected="selected">- Seleccionar -</option>
                      </select>
                    </div>
                    <span class="help-block text-danger" id="error"></span>
                  </div>

                  <div class="col-12 col-sm-4 col-md-4 mb-3">
                    <label>Distrito <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <select name="cbo-distrito" id="cbo-distrito" class="form-select">
                        <option value="0" selected="selected">- Seleccionar -</option>
                      </select>
                    </div>
                    <span class="help-block text-danger" id="error"></span>
                  </div>

                  <div class="col-12 col-sm-12 col-md-12 mb-3">
                    <label>Dirección <span class="label-advertencia text-danger"> *</span></label>
                    <div class="form-group">
                      <input type="text" id="payment-direccion" inputmode="text" name="address" class="form-control required" placeholder="Ingresar" maxlength="100" autocomplete="address">
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
          <h2 class="text-left mb-3 fw-bold">Medios de Pago</h2>
          
          <?php
          if($arrMedioPago['status']=='success') {
            foreach($arrMedioPago['result'] as $row){
              //array_debug($row);
            ?>
            
            <div class="card mb-3" style="border: none;">
              <div class="card-body shadow p-3 bg-body rounded pb-0 pt-0">
                <div class="row">
                  <div class="col-12">
                    <div class="form-check ps-0" style="cursor: pointer;flex-wrap: wrap-reverse;display: flex;">
                      <label style="cursor: pointer;" class="col-12" for="<?php echo $row->ID_Medio_Pago; ?>" data-id="<?php echo $row->ID_Medio_Pago; ?>">
                        <div class="d-flex p-3">
                          <div class="flex-shrink-0 text-center" style="width:20%">
                            <img class="img-medio_pago shadow-sm bg-body rounded" src="<?php echo $row->Txt_Url_Imagen . '?ver=1.0.0'; ?>">
                          </div>
                          <div class="mb-2 ps-3">
                            <h6 class="ps-2"><?php echo ($row->Nu_Tipo_Cuenta == 1 ? 'Cuenta Corriente' : 'Número'); ?></h6>
                            <div class="modal-cart_shop-div-precio_item ps-2">
                              <span class="fw-bold">
                                <span><?php echo $row->No_Cuenta_Bancaria; ?></span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </label>

                      <input style="cursor: pointer;margin-bottom: 2.5rem !important;" class="form-check-input" type="radio" name="arrMedioPago" id="<?php echo $row->ID_Medio_Pago; ?>" data-id="<?php echo $row->ID_Medio_Pago; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
            }
          } else {

          }
          ?>
        </div>
        
      </div>
      
      <div class="col-12 col-sm-4 col-md-4">
        <div class="col-12 col-sm-12 col-md-12 sticky-top">
          <h2 class="text-center mb-3 fw-bold">Resumen</h2>
            <div class="card" style="border: none;">
            <div class="card-body shadow p-3 bg-body rounded pt-0">
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
              <div class="d-block d-sm-none">
                <br><br><br><br><br><br><br>
              </div>

              <div class="d-none d-sm-block">
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
                  <button type="button" class="btn btn-primary btn-lg btn-completar_pedido">Finalizar pedido</button>
                </div>
              </div>

              <div class="d-block d-sm-none totales-payment fixed-bottom bg-white p-3 shadow pt-0">
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
                  <button type="button" class="btn btn-primary btn-lg btn-completar_pedido">Finalizar pedido</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>