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
use app\models\PayPaymentsRecibed;
use app\models\EntUsuariosCreditos;
use app\models\IPNPayPal;
use app\modules\ModUsuarios\models\EntUsuarios;

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

            return $this->vistaPago($producto, $formaPago);

        }

    }

	public function crearOrdenCompra($producto, $formaPago){
		 
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
           return  $ordenCompra;
	}

	/**
	 * IPN para payl pal
	 */
	public function actionIpnPaypal() {
		$payPal = new IPNPayPal ();
		$payPal->payPalIPN ();
	}

    private function vistaPago($producto, $formaPago){
        $ordenCompra = $this->crearOrdenCompra($producto, $formaPago);
        switch ($formaPago->id_payment_type){
            case 1:
                return $this->renderAjax('formPayPal', ['ordenCompra'=>$ordenCompra]);
            break;
            case 2:
				$ordenCompra2 = $this->crearOrdenCompra($producto, $formaPago);

                $charger =  $this->generarOrdenCompraOpenPay($ordenCompra->txt_description, $ordenCompra->txt_order_number, $ordenCompra->num_total);
                return $this->renderAjax('openPay', ['charger'=>$charger, 'ordenCompra'=>$ordenCompra, 'ordenCompra2'=>$ordenCompra2]);
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
    	return $pago->oPCodeBar($description, $orderNumber, $monto);
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
        $this->crearLog('Open Pay','type: ' . $json ['type'] );
		$this->crearLog('Open Pay',"event_date: " . $json ['event_date']);
		
		
		switch ($json ['type']) {
			case "verification" :
                $this->crearLog('Open Pay',"Codigo de verificacion: " . $json ['verification_code']);
                $this->crearLog('Open Pay',"Id de peticion: " . $json ["id"]);
			
				break;
			
			case "charge.succeeded" :
			 	$this->crearLog('Open Pay',"Inicio de proceso de pago");
				$this->processPaymentOP ( $json, $entityBody );
				break;
		}
	}

    // $userCreditos = new EntUsuariosCreditos();
	// 		$userCreditos->agregarCreditos($comentario->id_usuario, $contestar->costo);

    /**
	 * Guarda registro del pago
	 *
	 * @param unknown $json        	
	 * @param unknown $data        	
	 */
	private function processPaymentOP($json, $data) {
		$transaction = $json ['transaction'];
		
		$txn_id = $transaction ['id'];
		$payment_amount = $transaction ['amount'];
		$payment_currency = "NOT DEFINED";
		$payment_status = $transaction ['status'];
		$quantity = 1;
		$mc_gross = $transaction ['amount'];
		$order_id = $transaction ['order_id'];
		
		$ordenCompra = PayOrdenesCompras::find()->where(['txt_order_number'=>$order_id,'b_pagado'=>0])->one();
		
		if(empty($ordenCompra)){
			$this->crearLog ('OpenPayError', "El order ID no existe o ya esta marcado como completo :" . $order_id );
			return;
		}
			
		// Carga la orden
		$item_number = $ordenCompra->txt_order_number;
		$custom = $ordenCompra->id_usuario;
		$item_name = $ordenCompra->txt_description;
		
		$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "------------- PAGO RECIBIDO de transacción :$txn_id -----------\n\r" );
		
		// Solo genera el log cambiar al de yii
		if (true) {
			
			$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, 
                                "Item name:" . $item_name . "\n\r" . 
                                "Item number :" . $item_number . "\n\r" . 
                                "quantity :" . $quantity . "\n\r" . 
                                "Payment Status :" . $payment_status . "\n\r" . 
                                "Payment amount :" . $payment_amount . "\n\r" . 
                                "Txn Id :" . $txn_id . "\n\r" . 
                                "custom :" . $custom . "\n\r" . 
                                "mc gross :" . $mc_gross . "\n\r" );
		}
		
		// VALIDA QUE LA TRANSACCION NO SE ENCUIENTRE REGISTRADA EN LA BASE DE DATOS PREVIAMENTE
        $pagoRecibed = PayPaymentsRecibed::find()->where(['txt_transaccion'=>$txn_id])->one();

		
		if (! empty ( $pagoRecibed )) {
			$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "TRANSACCION REPETIDA: $txn_id \n\r" );
			return;
		}
		
		// Verifica el precio vs el producto
		if (( double ) $ordenCompra->num_total != ( double ) $mc_gross) {
			$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "PRODUCTO Y MONTO INCORRECTO: id_product=$item_number AND num_price=$mc_gross\n\r" );
			return;
		}
		
		// Verifica que la cantidad de productos adquiridos sean 1
		if ($quantity != 1) {
			$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "CANTIDAD DE PRODUCTOS INCORRECTO: quantity=$quantity\n\r" );
		}
		
		$pagoRecibido = new PayPaymentsRecibed ();
		$pagoRecibido->id_usuario = $ordenCompra->id_usuario;
		$pagoRecibido->id_tipo_pago = 2;
		$pagoRecibido->txt_transaccion_local = 'Local';
		$pagoRecibido->txt_notas = 'Notas';
		$pagoRecibido->txt_estatus = $payment_status;
		$pagoRecibido->txt_transaccion = $txn_id;
		$pagoRecibido->txt_cadena_comprador = $data;
		$pagoRecibido->txt_monto_pago = $mc_gross;
		$pagoRecibido->id_orden_compra = $ordenCompra->id_orden_compra;
		
		$producto = $ordenCompra->idProducto;	

		$transaction = Yii::$app->db->beginTransaction();
		$error = false;
		try {
			if ($pagoRecibido->save ()) {

				$ordenCompra->b_pagado = 1;
				if($ordenCompra->save()){
					
					$userCreditos = new EntUsuariosCreditos();
					$userCreditos->agregarCreditos($ordenCompra->id_usuario, $producto->num_creditos, 'Compra de '.$producto->num_creditos.' créditos');
					
					$usuario = EntUsuarios::find()->where(['id_usuario'=>$ordenCompra->id_usuario])->one();
					$utils = new \app\modules\ModUsuarios\models\Utils();
					$parametrosEmail = [
							'nombre' => $usuario->txt_username,
							'ap_paterno' => $usuario->txt_apellido_paterno,
							'numCreditos' => $producto->num_creditos,
							'formaPago'=>$ordenCompra->idPaymentType->txt_name,
							'transaccion'=>$ordenCompra->txt_order_number,
							'totalPagado'=>$ordenCompra->num_total
					];
				
					$utils->sendPagoNotificacion($usuario->txt_email, $parametrosEmail );

				}else{
					$error = true;
					$this->crearLog('OpenPayUser'.$ordenCompra->id_usuario, 'No se puedo actualizar la orden de compra'. json_encode ( $ordenCompra->errors) );
				}
				
			} else {
				$error = true;
				$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "Error al guardar el pago " . json_encode ( $pagoRecibido->errors) );
			}
			if ($error) {
				$transaction->rollback ();
				return;
			} else {
				$transaction->commit ();
			}
		} catch ( ErrorException $e ) {
			$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "Ocurrio un problema al guardar la información=print_r($e)\n\r" );
			$transaction->rollback ();
		}
		
		$this->crearLog ('OpenPayUser'.$ordenCompra->id_usuario, "------------------- PAGO CORRECTO ---------------------\n\r" );
	}
    

    public function crearLog($nombreArchivo,$message){
        
        $basePath = Yii::getAlias('@app'); 
        $fichero = $basePath.'/logsPagos/'.$nombreArchivo.'.log';

        $persona =  Utils::getFechaActual()."\n".$message."\n\n";
        
        $fp = fopen($fichero,"a");
        fwrite($fp,$persona);
        fclose($fp);
    }
    
}
