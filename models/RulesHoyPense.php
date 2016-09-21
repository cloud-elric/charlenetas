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
								'imagen'
						],
						'image',
						'skipOnEmpty' => true,
				
						'extensions' => 'png, jpg, jpeg',
						'on' => 'editarHoyPense'
				],
				[
						[
								'txt_titulo', 'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearHoyPense'
				],
				[
						[
								'txt_titulo', 'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'editarHoyPense'
				]
		]
		;

		return $rules;
	}
}