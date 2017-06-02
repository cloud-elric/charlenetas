<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use vendor\facebook\FacebookI;
use app\models\Pagos;
use app\models\Utils;
use app\models\Products;
use app\models\PayCatPaymentsTypes;
use app\models\PayOrdenesCompras;
use yii\web\BadRequestHttpException;

class PagosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
		return [ 
				'access' => [ 
						'class' => \yii\filters\AccessControl::className (),
						'only' => [ 
								'generar-ticket-open-pay',
                                'forma-pago',
                                'seleccionar-producto',
                                'generar-orden-compra',
                                'pagar-tarjeta-open-pay'
						],
						'rules' => [
								
								// allow authenticated users
								[ 
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				] 
		];
		// everything else is denied
	}

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Genera la orden de compra
     */
    public function actionGenerarOrdenCompra(){

        if(isset($_POST['producto']) && isset($_POST['formaPago'])  ){
            $producto = $this->getProductoByToken($_POST['producto']);
            $formaPago = $this->getFormaPagoByToken($_POST['formaPago']);
            $idUsuario = Yii::$app->user->identity->id_usuario;
            $idFormaPago = $formaPago->id_payment_type;
            $idProducto = $producto->id_product;
            $ordenNumber = Utils::generateToken('oc_');
            $numSubTotal = $producto->num_price;
            $numTotal = $producto->num_price;
            $descripcion = 'Compra de '.$producto->txt_name;


            $ordenCompra = new PayOrdenesCompras();
            $ordenCompra->txt_order_number = $ordenNumber;
            $ordenCompra->txt_description = $descripcion;
            $ordenCompra->id_usuario = $idUsuario;
            $ordenCompra->id_payment_type = $idFormaPago;
            $ordenCompra->id_producto = $idProducto;
            $ordenCompra->fch_creacion = Utils::getFechaActual();
            $ordenCompra->b_pagado = 0;
            $ordenCompra->num_sub_total = $numSubTotal;
            $ordenCompra->num_total = $numTotal;
            $ordenCompra->b_habilitado = 1;

            $ordenCompra->save();

            return $this->vistaPago($ordenCompra);

        }

    }

    private function vistaPago($ordenCompra){
        
        switch ($ordenCompra->id_payment_type){
            case 1:
                return $this->renderAjax('formPayPal', ['ordenCompra'=>$ordenCompra]);
            break;
            case 2:
                $charger =  $this->generarOrdenCompraOpenPay($ordenCompra->txt_description, $ordenCompra->txt_order_number, $ordenCompra->num_total);
                return $this->renderAjax('openPay', ['charger'=>$charger, 'ordenCompra'=>$ordenCompra]);
            break;

        }
    }

    

    public function actionSeleccionarProducto(){
       $productos = Products::find()->where(['b_enabled'=>1])->orderBy('num_order')->all();


        return $this->render('formaPago', ['productos'=>$productos]);
    }

    private function getProductoByToken($token){
        $producto = Products::find()->where(['txt_product_number'=>$token])->one();

        if($producto){
            return $producto;
        }else{
            throw new NotFoundHttpException ( 'The requested page does not exist.' );
        }
        
    }

    private function getFormaPagoByToken($token){
         $formaPago = PayCatPaymentsTypes::find()->where(['txt_payment_type_number'=>$token])->one();

        if($formaPago){
            return $formaPago;
        }else{
            throw new NotFoundHttpException ( 'The requested page does not exist.' );
        }
    }
    
    private function generarOrdenCompraOpenPay($description='Descripción del producto', $orderNumber=null, $monto ){
    	$pago = new Pagos();
    	$orderId = Utils::generateToken('odc');
    	return $pago->oPCodeBar($description, $orderId, $monto);
    }


    public function actionPagarTarjetaOpenPay(){

            $pago = new Pagos();

            if (isset ( $_POST ["token_id"] ) && $_POST ["orderId"] && $_POST['deviceIdHiddenFieldName']) {
			
            $ordenCompra = PayOrdenesCompras::find()->where(['txt_order_number'=>$_POST['orderId']])->one();
	
			if (empty ( $ordenCompra )) {
				throw new BadRequestHttpException ( 400, 'Datos requeridos.' );
			}
			
			try {
				$charge = $pago
                    ->createChargeCreditCard ( $ordenCompra->txt_description, $ordenCompra->txt_order_number, $ordenCompra->num_total, $_POST ["token_id"], $_POST['deviceIdHiddenFieldName']);
				
				echo "success";
			} catch ( Exception $e ) {
				

				echo $e->getMessage ();
				
			}
			
			
			exit;
			
		}
    }

    /**
	 * Open pay hara el registro del pago en este action
	 */
	public function actionOpWebHook() {
		$entityBody = file_get_contents ( 'php://input' );
		$json = json_decode ( $entityBody, true );
		
        $this->crearLog('Open Pay', '------------- RECEPCION DE WEBHOOK -------------------');
        $this->crearLog('Open Pay','type' . $json ['type'] );
		$this->crearLog('Open Pay',"event_date " . $json ['event_date']);
		
		
		switch ($json ['type']) {
			case "verification" :
                $this->crearLog('Open Pay',"Codigo de verificacion:" . $json ['verification_code']);
                $this->crearLog('Open Pay',"Id de peticion:" . $json ["id"]);
			
				break;
			
			case "charge.succeeded" :
				$this->processPaymentOP ( $json, $entityBody );
				break;
		}
	}
    

    public function crearLog($nombreArchivo,$message){
        
        $basePath = Yii::getAlias('@app'); 
        $fichero = $basePath.'/logsPagos/logexameple.log';

        $persona =  Utils::getFechaActual().$message."\n";
        
        $fp = fopen($fichero,"a");
        fwrite($fp,$persona);
        fclose($fp);
    }
    
}
