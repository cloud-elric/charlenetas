<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="form-pay-pal">
<!--<form action="https://www.paypal.com/cgi-bin/webscr" id="form-pay-pal">-->
    <?php echo Html::hiddenInput("cmd", '_xclick')?>
    <?php echo Html::hiddenInput("return", "<?=Url::base()?>")?>
    <?php echo Html::hiddenInput("custom", $ordenCompra->id_usuario)?>
    <?php echo Html::hiddenInput("notify_url", Url::base()."/pagos/ipn-paypal")?>
    <?php echo Html::hiddenInput("lc", 'MX')?>
    <?php echo Html::hiddenInput("business", 'beto@2gom.com.mx')?>
    <?php echo Html::hiddenInput("item_name", $ordenCompra->txt_description)?>
    <?php echo Html::hiddenInput("item_number", $ordenCompra->txt_order_number)?>
    <?php echo Html::hiddenInput("amount", $ordenCompra->num_total)?>
    <?php echo Html::hiddenInput("currency_code", 'MXN')?>
    <input TYPE="hidden" name="charset" value="utf-8">
    <button>Ir a paypal y pagar</button>
</form>