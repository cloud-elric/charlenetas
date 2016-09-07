<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_usuarios_calificacion_alquimia".
 *
 * @property string $id_post
 * @property string $id_usuario
 * @property string $num_calificacion
 *
 * @property EntPosts $idPost
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntUsuariosCalificacionAlquimia extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'ent_usuarios_calificacion_alquimia';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'id_post',
								'id_usuario' 
						],
						'required' 
				],
				[ 
						[ 
								'id_post',
								'id_usuario',
								'num_calificacion' 
						],
						'integer' 
				],
				[ 
						[ 
								'id_post' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => EntPosts::className (),
						'targetAttribute' => [ 
								'id_post' => 'id_post' 
						] 
				],
				[ 
						[ 
								'id_usuario' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => EntUsuarios::className (),
						'targetAttribute' => [ 
								'id_usuario' => 'id_usuario' 
						] 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id_post' => 'Id Post',
				'id_usuario' => 'Id Usuario',
				'num_calificacion' => 'Num Calificacion' 
		];
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdPost() {
		return $this->hasOne ( EntPosts::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdUsuario() {
		return $this->hasOne ( ModUsuariosEntUsuarios::className (), [ 
				'id_usuario' => 'id_usuario' 
		] );
	}
	
	/**
	 * Guarda la calificacion del usuario de la alquimia
	 *
	 * @param unknown $idUsuario        	
	 * @param unknown $idPost        	
	 * @param unknown $numCalificacion        	
	 * @return EntUsuariosCalificacionAlquimia|NULL
	 */
	public function guardarCalificacionUsuario($idUsuario, $idPost, $numCalificacion) {
		$this->id_usuario = $idUsuario;
		$this->id_post = $idPost;
		$this->num_calificacion = $numCalificacion;
		
		return $this->save () ? $this : null;
	}
	
	/**
	 * Revisa si existe la calificacion del usuario
	 *
	 * @param unknown $idUsuario        	
	 * @param unknown $idPost        	
	 * @return boolean
	 */
	public static function existsCalificacionUsuario($idUsuario, $idPost) {
		$calificacionUsuario = EntUsuariosCalificacionAlquimia::find ()->where ( [ 
				'id_usuario' => $idUsuario,
				'id_post' => $idPost 
		] )->one ();
		
		if ($calificacionUsuario) {
			return $calificacionUsuario;
		}
		
		return false;
	}
}
