<main>
<br><br>
<!--
<br><br>
-->
<?php

//array_debug($arrResponsePedido);
//array_debug($arrCabecera);
//array_debug($arrDetalle);
//array_debug($arrMedioPago);
//echo base_url();

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
foreach($arrDetalle as $row) {
  $row = (array)$row;
  $message .= "✅ " . number_format($row['cantidad_item'], 2, '.', ',') . " x *" . $row['nombre_item'] . "* - S/ " . number_format($row['precio_item'], 2, '.', ',') . "\n";
}

$message .= "\n📍 *Dirección:* " . $arrCabecera['cliente']['Txt_Direccion'];
  
//Totales
$message .= "\n*Importe Total:* S/ " . number_format($arrCabecera['documento']['importe_total'], 2, '.', ',');
$message .= "\n*Cantidad Total:* S/ " . number_format($arrCabecera['documento']['cantidad_total'], 2, '.', ',');

$message = urlencode($message);

$sURLSendMessageWhatsapp = "https://api.whatsapp.com/send?phone=" . $phone . "&text=" . $message;

//$sURLSendMessageWhatsapp = "https://api.whatsapp.com/send?phone=51915914064&text=hola";
//echo $sURLSendMessageWhatsapp;
?>

  <div class="container mt-5">
    <h2 class="text-center mb-4 pt-3 text-success"><i class="fa-solid fa-circle-check fa-3x text-green"></i></h2>
    <h2 class="text-center mb-4">Nro. Pedido <?php echo $arrCabecera['documento']['id_pedido']; ?> creado</h2>
    <a class="btn btn-outline-success btn-lg btn-block mb-4 shadow" style="width:100%" href="<?php echo $sURLSendMessageWhatsapp; ?>" target="_blank" rel="noopener noreferrer">Pedir por WhatsApp</a>

    <h3 class="text-center mb-4 fw-bold">Total a pagar S/ <?php echo round(($arrCabecera['documento']['importe_total'] / 2), 2); ?></h3>

    <form class="form row g-3" role="form" id="attachform" enctype="multipart/form-data">
      <input type="hidden" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $arrCabecera['documento']['id_pedido']; ?>">
      <div class="col-12 col-sm-12" style="cursor: pointer">
        <input class="form-control form-control-lg" id="voucher" type="file" name="voucher" style="cursor: pointer">
      </div>
      <div class="col-12 col-sm-12">
        <button type="submit" id="btn-file_voucher" class="btn btn-primary btn-lg btn-block shadow" style="width:100%">Enviar</button>
      </div>
    </form>

    <div class="row">
      <?php
      if($arrMedioPago['status']=='success') { ?>
        <div class="col-12 col-sm-6 col-md-6">
          <h2 class="text-left mb-4 fw-bold">Cuentas Bancarias</h2>
          <?php foreach($arrMedioPago['result'] as $row){ ?>
            <div class="card mb-3" style="border: none;">
              <div class="card-body shadow p-3 bg-body rounded pb-0 pt-0">
                <div class="row">
                  <div class="col-12">
                    <div class="modal-cart_shop-div_item">
                      <div class="modal-cart_shop-img_item">
                        <img class="img-medio_pago shadow-sm bg-body rounded" src="<?php echo $row->Txt_Url_Imagen . '?ver=1.0.0'; ?>">
                      </div>
                      <div class="modal-cart_shop-body_item ps-3">
                        <h6 class="ps-2"><?php echo ($row->Nu_Tipo_Cuenta == 1 ? 'Cuenta Corriente' : 'Número'); ?></h6>
                        <div class="modal-cart_shop-div-precio_item ps-2">
                          <span class="fw-bold">
                            <span><?php echo $row->No_Cuenta_Bancaria; ?></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } //for each medio de pago ?>
        </div>
      <?php
      }//if each medio de pago
      ?>
      
      <div class="col-12 col-sm-6 col-md-6 mt-3 mt-sm-0">
        <h2 class="text-left mb-4 fw-bold">Resumen</h2>
          <div class="card" style="border: none;">
          <div class="card-body shadow p-3 bg-body rounded pt-0 mb-3">
            <?php //aqui borrar session carrito ?>
            <?php
            $fTotalCantidadPedido = 0;
            $fTotalImportePedido = 0;
            foreach($arrDetalle as $row){
              $row = (array)$row;
              $fTotalCantidadPedido = $row['cantidad_item'];
              $fTotalImportePedido = $row['total_item'];
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
                <span class="fw-bold fs-5">
                  Total
                </span>

                <span class="fw-bold float-right fs-5">
                  <input type="hidden" id="hidden-cart_shop-cantidad_total" class="form-control" value="<?php echo $fTotalCantidadPedido; ?>">
                  <input type="hidden" id="hidden-cart_shop-importe_total" class="form-control" value="<?php echo $fTotalImportePedido; ?>">
                  S/ <span><?php echo number_format($arrCabecera['documento']['importe_total'], 2, '.', ','); ?></span>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  /*
  setTimeout(function () {
    window.open("<?php echo $sURLSendMessageWhatsapp; ?>", "_blank");
    //window.location = '<?php echo $sURLSendMessageWhatsapp; ?>';
  }, 2100);
  */
</script>
