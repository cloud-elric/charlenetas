<?php

namespace app\models;

class RulesSoloPorHoy {

	/**
	 * Reglas para un post de Solo Por Hoy
	 */
	public static function rulesCrearSoloPorHoy() {
		$rules = [
				[
						[
								'imagen'
						],
						'image',
						'skipOnEmpty' => false,

						'extensions' => 'png, jpg, jpeg',
						'on' => 'crearSoloPorHoy'
				],
				[
						[
								'txt_descripcion', 'fch_publicacion'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'editarSoloPorHoy'
				],
		]
		;

		return $rules;
	}
}