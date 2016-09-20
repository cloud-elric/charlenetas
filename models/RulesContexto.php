<?php

namespace app\models;

class RulesContexto {

	/**
	 * Reglas para un post de Contexto
	 */
	public static function rulesCrearContexto() {
		$rules = [
				[
						[
								'imagen'
						],
						'image',
						'skipOnEmpty' => false,

						'extensions' => 'png, jpg, jpeg',
						'on' => 'crearContexto'
				],
				[
						[
								'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearContexto'
				],
		]
		;

		return $rules;
	}
}