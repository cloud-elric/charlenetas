 
<?php
use yii\helpers\Url;
?>

<ul class="collapsible" data-collapsible="accordion">
    <li>
        <div class="collapsible-header"><i class="ion ion-ios-barcode"></i>Imprimir ticket</div>
        <div class="collapsible-body">
            <div>
                <div class="btn-floating btn-large waves-effect waves-light green print-button js-print-button">
                    <i class="ion ion-printer"></i>
                </div>
            </div>
            <div class="tickert-print">

                <div class="whitepaper">
                    <div class="header center-align">
                        <div class="row">
                            <div class="col m6 offset-m3">
                                <img src="<?=Url::base()?>/webAssets/images/logo-charlenetas.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row center-align">
                        <div class="col m6">
                            <img  src="<?=$charger->payment_method->barcode_url?>" alt="Código de Barras">
                            <div><?=$charger->payment_method->reference?></div>
                            <small>
                                En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.
                            </small>
                        </div>
                    
                        <div class="col m6 center-align">
                            <h4>Total a pagar</h4>
                            <h3>$ <?=number_format($charger->amount)?>
                                <small> MXN</small>
                            </h3>
                            <h3>más comisión</h3>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col m12">
                            <h3>Detalles de la compra</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m12">

                            <div class="row">
                                <div class="col m3 offset-m3 right-align ">
                                    <span>
                                        Descripción:
                                    </span>
                                </div>
                                <div class="col m6">
                                    <span>
                                        <?=$charger->description?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col m3 offset-m3 right-align ">
                                    <span>
                                        Fecha y hora:
                                    </span>
                                </div>
                                <div class="col m6">
                                    <span>
                                        <?=$charger->creation_date?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col m3 offset-m3 right-align ">
                                    <span>
                                        Monto a pagar:
                                    </span>
                                </div>
                                <div class="col m6">
                                    <span>
                                        $ <?=number_format($charger->amount)?> MXN más comisión
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col m6">
                            <h5>Como realizar el pago</h5>
                            <ul class="collection">
                                <li class="collection-item">
                                    1.- Acude a cualquier tienda afiliada
                                </li>
                                <li class="collection-item">
                                    2.- Entrega al cajero el código de barras y menciona que 
                                    realizarás un pago de servicio Paynet
                                </li>
                                <li class="collection-item">
                                    3.- Realizar el pago en efectivo por $ <?=number_format($charger->amount)?> 
                                    más comisión
                                </li>
                                <li class="collection-item">
                                    4.- Conserva el ticket para cualquier aclaración
                                </li>
                            </ul>
                            <div class="row">
                                <div class="small">
                                    <b>Si tienes dudas comunicate a NOMBRE TIENDA al teléfono TELEFONO TIENDA o al correo CORREO SOPORTE TIENDA</b>
                                </div> 
                            </div>
                        </div>
                        <div class="col m6">
                            <h5>Instrucciones para el cajero</h5>
                            <ul class="collection">
                                    <li class="collection-item">
                                        1.- Ingresar al menú de Pago de Servicios
                                    </li>
                                    <li class="collection-item">
                                        2.- Seleccionar Paynet
                                    </li>
                                    <li class="collection-item">
                                        3.- Escanear el código de barras o ingresar el núm. de referencia
                                    </li>
                                    <li class="collection-item">
                                        4.- Ingresa la cantidad total a pagar
                                    </li>
                                    <li class="collection-item">
                                        5.- Cobrar al cliente el monto total más la comisión
                                    </li>
                                    <li class="collection-item">
                                        6.- Confirmar la transacción y entregar el ticket al cliente
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="small">
                                        <b>Para cualquier duda sobre como cobrar, por favor llamar al teléfono 
                                        01 800 300 08 08 en un horario de 8am a 9pm de lunes a domingo</b>
                                    </div>
                                </div>   
                        </div>
                    </div>

                    <hr>
                    <div class="row center-align valign-wrapper footer-images">
                        <div class="col m3"><img class="responsive-img" src="<?=Url::base()?>/images/openpay/7eleven.png" alt="7elven"></div>
                        <div class="col m3"><img class="responsive-img" src="<?=Url::base()?>/images/openpay/extra.png" alt="7elven"></div>
                        <div class="col m3"><img class="responsive-img" src="<?=Url::base()?>/images/openpay/farmacia_ahorro.png" alt="7elven"></div>
                        <div class="col m3"><img class="responsive-img" src="<?=Url::base()?>/images/openpay/benavides.png" alt="7elven"></div>
                        
                    </div>

                    <div class="row">
                        <div class="col m12 center-align">
                            <small>
                                ¿Quieres pagar en otras tiendas? <br> visita: www.openpay.mx/tiendas
                            </small>
                        </div>
                    </div>

                    <div class="row center-align">
                        <img style="height:20px;" class="responsive-img" src="<?=Url::base()?>/images/openpay/powered_openpay.png" alt="Powered by Openpay">
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="ion ion-card"></i>Pagar con tarjeta de crédito</div>
        <div class="collapsible-body">
            <form
                action="<?=Url::base()?>/pagos/pagar-tarjeta-open-pay"
                method="POST" id="payment-form">
                <input type="hidden" name="token_id" id="token_id">
                <div class="container-form-pago-tarjeta">

                    <div class="row">
                        <div class="col m4">
                            <h5>
                                Tarjetas de crédito
                            </h5>
                            <div class="tarjetas-credito">

                            </div>
                        </div>
                        <div class="col m8">
                            <h5>
                                Tarjetas de débito
                            </h5>
                            <div class="tarjetas-debito">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col m6">
                            <input value="Humberto Antonio" id="nombre-titular"
                                    type="text"
                                    autocomplete="off" data-openpay-card="holder_name">
                            <label for="nombre-titular">Nombre del titular (Como aparece en tarjeta)</label>        
                        </div>
                        <div class="input-field col m6">
                            <input value="<?=$ordenCompra2->txt_order_number?>"
                                    type="hidden" name="orderId"> 
                            <input type="text" id="numero-tarjeta"
                                    autocomplete="off" data-openpay-card="card_number"
                                    maxlength="16" value="4111111111111111">
                             <label for="numero-tarjeta">Número de tarjeta</label>        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m6">
                            <label>
                                Fecha de expiración
                            </label>
                            <div class="row">
                                <div class="input-field col m6">
                                     <input type="number" value="12" maxlength="2" min="0" max="12" type="text" placeholder="Mes"
                                        data-openpay-card="expiration_month">
                                </div>
                                <div class="input-field col m6">
                                    <input value="17" maxlength="2" type="number" min="17" max="99" placeholder="Año"
                                        data-openpay-card="expiration_year">
                                </div>
                            </div>
                        </div>

                         <div class="col m6">
                            <label for="codigo-seguridad">
                               Código de seguridad
                            </label>
                            <div class="row">
                                <div class="input-field col m6">
                                     <input value="" id="codigo-seguridad" type="text" placeholder="3 dígitos"
                                        autocomplete="off" data-openpay-card="cvv2">
                                </div>
                                <div class="col m6">
                                    <div class="help-codigo-seguridad"></div>
                                </div>
                            </div>
                        </div>    

                    </div>


                    <div class="row">
                        <div class="col m4">
                            <div>
                                <small>Transacciones realizadas vía:</small>
                            </div>
                            <div class="logo-open-pay">

                            </div>
                        </div>
                        <div class="col m4">
                            <div class="shield">

                            </div>
                            
                            <small>
                                Tus pagos se realizan de forma segura con encriptación de 256 bits
                            </small>
                            
                        </div>
                        <div class="col m4 center-align">
                            <button id="pay-button" class="waves-effect waves-light btn  btn-large btn-pagar-tarjeta">
                                Pagar
                            </button>
                        </div>
                    </div>    


                </div>
            </form>
        </div>
    </li>

  </ul>

<script>
$(document).ready(function(){
    $('.collapsible').collapsible();

    $('.js-print-button').on('click', function(e){
        e.preventDefault();

        $('.tickert-print').printArea({
            mode: 'iframe'
        });
    });

    console.log('aqui');


      OpenPay.setId('mgvepau0yawr74pc5p5x');
         OpenPay.setApiKey('pk_a4208044e7e4429090c369eae2f2efb3');
            
            OpenPay.setSandboxMode(true);
            //Se genera el id de dispositivo
            var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
            
            $('#pay-button').on('click', function(event) {
                event.preventDefault();
                $("#pay-button").prop( "disabled", true);
                OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);                
            });

            var sucess_callbak = function(response) {
                console.log(response);
              var token_id = response.data.id;
              $('#token_id').val(token_id);
              var forma = $('#payment-form');
			
			$.ajax({
				url: forma.attr("action"),
				data:forma.serialize(),
				method:"POST",
				success: function(response){

					if(response=="success"){
                        $("#pay-button").prop("disabled", false);
                        $('.lean-overlay').trigger('click');
						swal("Correcto", "La compra se ha procesado correctamente", "success");
                        paso1();
					}else{
						//toastrError(response);
						$("#pay-button").prop( "disabled", false);
					}
				},error:function(){

					}
			});
              
            };

            var error_callbak = function(response) {
                var desc = response.data.description != undefined ? response.data.description : response.message;
                
                //alert("ERROR [" + response.status + "] " + desc);
                swal("Un momento", 'Open pay rechazó el pago por: '+desc, "warning")
                $("#pay-button").prop("disabled", false);
            };

        


  });
</script>
