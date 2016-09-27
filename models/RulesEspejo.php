<?php

namespace app\models;

class RulesEspejo {

	/**
	 * Reglas para un post de Contexto
	 */
	public static function rulesCrearEspejo() {
		$rules = [
				[
						[
								'txt_descripcion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'agregarEspejo'
				],
		]
		;

		return $rules;
	}
}