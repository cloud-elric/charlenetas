<?php

namespace app\models;

class RulesHoyPense {

	/**
	 * Reglas para un post de Hoy Pense
	 */
	public static function rulesCrearHoyPense() {
		$rules = [
				[
						[
								'imagen'
						],
						'image',
						'skipOnEmpty' => false,

						'extensions' => 'png, jpg, jpeg',
						'on' => 'crearHoyPense'
				],
				[
						[
								'txt_titulo', 'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearHoyPense'
				],
		]
		;

		return $rules;
	}
}