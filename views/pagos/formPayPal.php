<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container">
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
                        <?=$ordenCompra->txt_description?>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col m3 offset-m3 right-align ">
                    <span>
                        Forma de pago:
                    </span>
                </div>
                <div class="col m6">
                    <span>
                        <?=$ordenCompra->idPaymentType->txt_name?>
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
                        $ <?=number_format($ordenCompra->num_total)?> MXN
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col m12 center-align">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="form-pay-pal">
                        <?php 
                            $return  = Yii::$app->urlManager->createAbsoluteUrl ( [ 
								''
			                ] );

                            $ipnUrl = Yii::$app->urlManager->createAbsoluteUrl ( [ 
								'pagos/ipn-paypal'
			                ] );
                        ?>

                    <!--<form action="https://www.paypal.com/cgi-bin/webscr" id="form-pay-pal">-->
                        <?php echo Html::hiddenInput("cmd", '_xclick')?>
                        <?php echo Html::hiddenInput("return", $return)?>
                        <?php echo Html::hiddenInput("custom", $ordenCompra->id_usuario)?>
                        <?php echo Html::hiddenInput("notify_url", $ipnUrl)?>
                        <?php echo Html::hiddenInput("lc", 'MX')?>
                        <?php echo Html::hiddenInput("business", 'beto@2gom.com.mx')?>
                        <?php echo Html::hiddenInput("item_name", $ordenCompra->txt_description)?>
                        <?php echo Html::hiddenInput("item_number", $ordenCompra->txt_order_number)?>
                        <?php echo Html::hiddenInput("amount", $ordenCompra->num_total)?>
                        <?php echo Html::hiddenInput("currency_code", 'MXN')?>
                        <input TYPE="hidden" name="charset" value="utf-8">
                        <button class="waves-effect waves-light btn  btn-large btn-pagar-tarjeta">Ir a paypal y pagar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>