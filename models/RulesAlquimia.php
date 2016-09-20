<?php

namespace app\models;

class RulesAlquimia {
	
	/**
	 * Reglas para un post de alquimia
	 */
	public static function rulesCrearAlquimia() {
		$rules = [ 
				[ 
						[ 
								'imagen' 
						],
						'image',
						'skipOnEmpty' => false,
						
						'extensions' => 'png, jpg, jpeg',
						'on' => 'crearAlquimia' 
				],
				[ 
						[ 
								'txt_titulo', 'txt_descripcion', 'fch_publicacion' 
						],
						'required',
						'message'=>'Requerido',
						'on' => 'crearAlquimia'
				],
		]
		;
		
		return $rules;
	}
}