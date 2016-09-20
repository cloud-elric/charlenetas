<?php

namespace app\models;

class RulesSabiasQue {

	/**
	 * Reglas para un post de Hoy Pense
	 */
	public static function rulesCrearSabiasQue() {
		$rules = [
				[
						[
								'b_verdadero', 'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearSabiasQue'
				],
		]
		;

		return $rules;
	}
}