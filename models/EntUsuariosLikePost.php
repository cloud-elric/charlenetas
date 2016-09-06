<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_usuarios_like_post".
 *
 * @property string $id_post
 * @property string $id_usuario
 *
 * @property EntPosts $idPost
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntUsuariosLikePost extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'ent_usuarios_like_post';
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
								'id_usuario' 
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
				'id_usuario' => 'Id Usuario' 
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
		return $this->hasOne ( EntUsuarios::className (), [ 
				'id_usuario' => 'id_usuario' 
		] );
	}
	
	/**
	 * Guarda al usuario con like al post
	 * 
	 * @param number $idUsuario        	
	 * @param number $idPost        	
	 * @return EntUsuariosLikePost | NULL
	 */
	public function guardarUsuarioLike($idUsuario, $idPost) {
		$this->id_usuario = $idUsuario;
		$this->id_post = $idPost;
		
		return $this->save () ? $this : null;
	}
	
	/**
	 * Busca si el usuario ya ha dado like a un post especifico
	 *
	 * @param unknown $idUsuario        	
	 * @param unknown $idPost        	
	 * @return boolean
	 */
	public static function existsUsuarioLike($idUsuario, $idPost) {
		$likeUsuario = EntUsuariosLikePost::find ()->where ( [ 
				'id_usuario' => $idUsuario,
				'id_post' => $idPost 
		] )->one();
		
		if ($likeUsuario) {
			return true;
		}
		
		return false;
	}
}
