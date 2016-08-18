<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_usuarios_feedbacks".
 *
 * @property string $id_comentario
 * @property string $id_usuario
 * @property string $id_tipo_feedback
 *
 * @property EntComentariosPosts $idComentario
 * @property ModUsuariosEntUsuarios $idUsuario
 * @property CatTiposFeedback $idTipoFeedback
 */
class EntUsuariosFeedbacks extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'ent_usuarios_feedbacks';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'id_comentario',
								'id_usuario',
								'id_tipo_feedback' 
						],
						'required' 
				],
				[ 
						[ 
								'id_comentario',
								'id_usuario',
								'id_tipo_feedback' 
						],
						'integer' 
				],
				[ 
						[ 
								'id_comentario' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => EntComentariosPosts::className (),
						'targetAttribute' => [ 
								'id_comentario' => 'id_comentario_post' 
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
				],
				[ 
						[ 
								'id_tipo_feedback' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => CatTiposFeedback::className (),
						'targetAttribute' => [ 
								'id_tipo_feedback' => 'id_tipo_feedback' 
						] 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id_comentario' => 'Id Comentario',
				'id_usuario' => 'Id Usuario',
				'id_tipo_feedback' => 'Id Tipo Feedback' 
		];
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdComentario() {
		return $this->hasOne ( EntComentariosPosts::className (), [ 
				'id_comentario_post' => 'id_comentario' 
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
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdTipoFeedback() {
		return $this->hasOne ( CatTiposFeedback::className (), [ 
				'id_tipo_feedback' => 'id_tipo_feedback' 
		] );
	}
	
	/**
	 * Guarda un registro para puntuar una calificacion
	 *
	 * @param number $idUsuario        	
	 * @param number $idComentario        	
	 * @param number $idFeedback        	
	 * @return EntUsuariosFeedbacks|NULL
	 */
	public function guardarUsuarioFeed($idUsuario, $idComentario, $idFeedback) {
		$this->id_comentario = $idComentario;
		$this->id_usuario = $idUsuario;
		$this->id_tipo_feedback = $idFeedback;
		
		return $this->save () ? $this : null;
	}
	
	/**
	 * Revisa si el usuario ya habia punteado el comentario
	 * 
	 * @param unknown $idUsuario
	 * @param unknown $idComentario
	 * @param unknown $idFeedback
	 * @return boolean
	 */
	public static function existFeedbackUsuario($idUsuario, $idComentario, $idFeedback) {
		$existe = EntUsuariosFeedbacks::find ()->where ( [ 
				'id_usuario' => $idUsuario,
				'id_comentario' => $idComentario,
				'id_tipo_feedback' => $idFeedback 
		] )->one ();
		
		if ($existe) {
			return true;
		}
		return false;
	}
}
