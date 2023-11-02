var signo_moneda='S/';
$(document).ready(function () {
  $('#div-footer-cart').hide();
  
  signo_moneda = $('#hidden-global-signo_moneda').val();

  $(document).on('click', '.btn-agregar_item', function() {
    const id_item = $( this ).data('id_item');
    const cantidad_item = parseFloat($( this ).data('cantidad_item'));
    const precio_item = parseFloat($( this ).data('precio_item'));

    console.log('id_item > ' + id_item);
    console.log('cantidad_item > ' + cantidad_item);
    console.log('precio_item > ' + precio_item);

    const total_item = (cantidad_item * precio_item);
    
    var arrParams = {
      id_item : id_item,
      cantidad_item : cantidad_item,
      precio_item : precio_item,
      total_item : total_item
    };
    requestAddCart(arrParams);
  });
});


function requestAddCart(arrParams) {
  $.post(base_url+'Inicio/agregarItem', {arrParams}, function(response) {
    console.log(response);
    if( response.status == 'success' ){
      const sCaracterPalabra = (response.count > 1 ? 's' : '');
      
      $('#span-cart-global_cantidad').html(response.count);
      $('#div-cart_items').html(response.count + ' producto' + sCaracterPalabra);
      $('#div-cart_total').html(signo_moneda + ' ' + arrParams.total_item);

      $('#div-footer-cart').show();
    } else {
      alert(response.message);
    }
  },'json');
}