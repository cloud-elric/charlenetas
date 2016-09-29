<?php

namespace app\models;

class RulesMedia {

	/**
	 * Reglas para un post de Media
	 */
	public static function rulesCrearMedia() {
		$rules = [
				[
						[
								'txt_url'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearMedia'
				],
				[
						[
								'txt_url'
						],
						'required',
						'message'=>'Requerido',
						'on' => 'editarMedia'
				]
		]
		;

		return $rules;
	}
}