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
          foreach($arrDetalle as $row){
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
<?php

//array_debug($arrCabecera);
//array_debug($arrDetalle);

$phone = "51" . $arrCabecera['cliente']['Nu_Celular_Entidad'];

//Preparar array para envío de data de pedido para la aplicación
$message = "!Hola *ProBusiness*!";
$message .= "\nAcabo de realizar el siguiente pedido.";

$message .= "\n\n👤 *Información de contacto:*";
$message .= "\n*Cliente:* " . $arrCabecera['cliente']['No_Entidad'];
$message .= "\n*" . $arrCabecera['documento']['tipo_documento_identidad'] . "*: " . $arrCabecera['cliente']['Nu_Documento_Identidad'];

$message .= "\n*Nro. Pedido:* " . $arrCabecera['documento']['id_pedido'];
$message .= "\n*Fecha:* " . ToDateHourBD($arrCabecera['documento']['fecha_registro']);

//Detalle de pedido
$message .= "\n\n*Detalle de Pedido*\n";
$message .= "===============\n";
foreach($arrDetalle as $row)
  $message .= "✅ " . number_format($row['cantidad_item'], 2, '.', ',') . " x *" . $row['nombre_item'] . "* - S/ " . number_format($row['precio_item'], 2, '.', ',') . "\n";

$message .= "\n📍 *Dirección:* " . $arrCabecera['cliente']['Txt_Direccion'];
  
//Totales
$message .= "\n*Importe Total:* S/ " . number_format($arrCabecera['documento']['importe_total'], 2, '.', ',');
$message .= "\n*Cantidad Total:* S/ " . number_format($arrCabecera['documento']['cantidad_total'], 2, '.', ',');

$message = urlencode($message);

$sURLSendMessageWhatsapp = "https://wa.me/" . $phone . "?text=" . $message;

//$sURLSendMessageWhatsapp = "https://api.whatsapp.com/send?phone=51915914064&text=hola";
//echo $sURLSendMessageWhatsapp;
?>
<script>
  setTimeout(function () {
    window.location = '<?php echo $sURLSendMessageWhatsapp; ?>';
  }, 2100);
</script>
