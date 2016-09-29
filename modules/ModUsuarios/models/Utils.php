<?php

namespace app\modules\ModUsuarios\models;

use Yii;

class Utils {
	
	/**
	 * Recupera el id de un video de youtube a partir de la url de youtube
	 *
	 * @param unknown $url        	
	 */
	public static function getIdVideoYoutube($url) {
		parse_str ( parse_url ( $url, PHP_URL_QUERY ), $params );
		
		if (key_exists ( 'v', $params )) {
			return $params ['v'];
		}
		
		return null;
	}
	
	/**
	 * Corta un texto y le coloca 3 puntos suspensivos al final
	 *
	 * @param unknown $string        	
	 * @param unknown $lenght        	
	 * @param number $start        	
	 * @return string|unknown
	 */
	public static function subStrTexto($string, $lenght, $start = 0) {
		$cadenaNueva = $string;
		if (strlen ( $string ) > $lenght) {
			$cadenaNueva = substr ( $string, $start, $lenght ) . '...';
		}
		return $cadenaNueva;
	}
	
	/**
	 * Cambia el formato de la fecha
	 * 
	 * @param unknown $string        	
	 */
	public static function changeFormatDate($string) {
		$date = date_create ($string );
		return date_format ( $date, "d-M-Y" );
	}
	
	/**
	 * Cambia el formato de la fecha del input al adecuado para la base de datos
	 * @param unknown $string
	 */
	public static function changeFormatDateInput($string){
		$date = date_create ($string );
		return date_format ( $date, "Y-m-d H:i:s" );
	}
	
	/**
	 * Obtenemos la fecha actual para almacenarla
	 *
	 * @return string
	 */
	public static function getFechaActual() {
		
		// Inicializamos la fecha y hora actual
		$fecha = date ( 'Y-m-d H:i:s', time () );
		return $fecha;
	}
	
	/**
	 * Genera un token para guardarlo en la base de datos
	 *
	 * @param string $pre        	
	 * @return string
	 */
	public static function generateToken($pre = 'tok') {
		$token = $pre . md5 ( uniqid ( $pre ) ) . uniqid ();
		return $token;
	}
	
	/**
	 * Obtiene fecha de vencimiento para una fecha
	 *
	 * @param unknown $fechaActualTimestamp        	
	 */
	public static function getFechaVencimiento($fechaActualTimestamp) {
		$date = date ( 'Y-m-d H:i:s', strtotime ( "+" . Yii::$app->params ['modUsuarios'] ['recueperarPass'] ['diasValidos'] . " day", strtotime ( $fechaActualTimestamp ) ) );
		
		return $date;
	}
	
	/**
	 * Envia el correo electronico para la activiación de la cuenta
	 *
	 * @param array $parametrosEmail        	
	 * @return boolean
	 */
	public function sendEmailActivacion($email, $parametrosEmail) {
		
		// Envia el correo electronico
		return $this->sendEmail ( '@app/modules/ModUsuarios/email/activarCuenta', '@app/modules/ModUsuarios/email/layouts/text', Yii::$app->params ['modUsuarios'] ['email'] ['emailActivacion'], $email, Yii::$app->params ['modUsuarios'] ['email'] ['subjectActivacion'], $parametrosEmail );
	}
	
	/**
	 * Envia el correo electronico para recuperar el correo electronico
	 *
	 * @param array $parametrosEmail        	
	 * @return boolean
	 */
	public function sendEmailRecuperarPassword($email, $parametrosEmail) {
		// Envia el correo electronico
		return $this->sendEmail ( '@app/modules/ModUsuarios/email/recuperarPassword', '@app/modules/ModUsuarios/email/layouts/text', Yii::$app->params ['modUsuarios'] ['email'] ['emailRecuperarPass'], $email, Yii::$app->params ['modUsuarios'] ['email'] ['subjectRecuperarPass'], $parametrosEmail );
	}
	
	/**
	 * Envia mensaje de correo electronico
	 *
	 * @param string $templateHtml        	
	 * @param string $templateText        	
	 * @param string $from        	
	 * @param string $to        	
	 * @param string $subject        	
	 * @param array $params        	
	 * @return boolean
	 */
	private function sendEmail($templateHtml, $templateText, $from, $to, $subject, $params) {
		return Yii::$app->mailer->compose ( [
				// 'html' => '@app/mail/layouts/example',
				// 'text' => '@app/mail/layouts/text'
				'html' => $templateHtml 
		], 
				// 'text' => $templateText
				$params )->setFrom ( $from )->setTo ( $to )->setSubject ( $subject )->send ();
	}
}