<?php

namespace app\models;

class RulesVerdadazos {

	/**
	 * Reglas para un post de verdadazos
	 */
	public static function rulesCrearVerdadazos() {
		$rules = [
				[
						[
								'imagen'
						],
						'image',
						'skipOnEmpty' => false,

						'extensions' => 'png, jpg, jpeg',
						'on' => 'crearVerdadazos'
				],
				[
						[
								'imagen'
						],
						'image',
						'skipOnEmpty' => true,
				
						'extensions' => 'png, jpg, jpeg',
						'on' => 'editarVerdadazos'
				],
				[
						[
								'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearVerdadazos'
				],
				[
						[
								'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'editarVerdadazos'
				]
		]
		;

		return $rules;
	}
}