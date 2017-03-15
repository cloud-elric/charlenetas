<?php

namespace app\models;

use Yii;

class Pagos {
	const PAY_PAL = 2;
	const OPEN_PAY =12;
	
	/**
	 * Generar codigo para poder pagar en las tiendas
	 */
	public function oPCodeBar($description = null, $orderId = null, $amount) {
		
		$this->alias = Yii::getAlias ( '@app' ) . '/vendor/openpay';
		
		require ($this->alias . DIRECTORY_SEPARATOR . 'Openpay.php');
		
		// Pruebas
		
		// $openpay = Openpay::getInstance('mgvepau0yawr74pc5p5x','pk_a4208044e7e4429090c369eae2f2efb3');
		
		// $openpay = Openpay::getInstance ( 'mgvepau0yawr74pc5p5x', 'sk_b1885d10781b4a05838869f02c211d48' );
		
		// Para producción usar el que empieza con pk_ para pruebas el sk y
		
		// para producción hay que cambiar el valor de la variable $sandboxMode a false en el archivo OpenpayApi.php
		
		$openpay = \Openpay::getInstance ( 'mgvepau0yawr74pc5p5x', 'sk_b1885d10781b4a05838869f02c211d48' );
		
		$custom = array (
				
				"name" => "-",
				
				"email" => "correo@dominio.com" 
		);
		
		$chargeData = array (
				
				'method' => 'store',
				
				'amount' => $amount,
				
				'description' => $description,
				
				'customer' => $custom,
				
				'order_id' => $orderId 
		);
		
		$charge = $openpay->charges->create ( $chargeData );
		
		
		$dataOpenPay ['txt_barcode_url'] = $charge->payment_method->barcode_url;
		
		$dataOpenPay ['txt_reference'] = $charge->payment_method->reference;
		
		$dataOpenPay ['num_amount'] = number_format ( $charge->amount );
		
		$dataOpenPay ['txt_currency'] = $charge->currency;
		
		$dataOpenPay ['txt_descripcion'] = $charge->description;
		
		$dataOpenPay ['fch_creation_date'] = $charge->creation_date;
		
		return $dataOpenPay;
	}
}



