<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\ConstantesWeb;

/**
 * This is the model class for table "ent_alquimias".
 *
 * @property string $id_post
 * @property string $num_calificacion_admin
 * @property string $num_calificacion_usuario
 *
 * @property EntPosts $idPost
 * @property EntCalificacionAlquimias[] $entCalificacionAlquimias
 * @property ModUsuariosEntUsuarios[] $idUsuarios
 */
class EntAlquimias extends \yii\db\ActiveRecord {
	
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'ent_alquimias';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'id_post',
								'num_calificacion_admin' 
						],
						'required' 
				],
				[ 
						[ 
								'id_post',
// 								'num_calificacion_admin',
// 								'num_calificacion_usuario' 
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
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id_post' => 'Id Post',
				'num_calificacion_admin' => 'Num Calificacion Admin',
				'num_calificacion_usuario' => 'Num Calificacion Usuario' 
		];
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntCalificacionAlquimias()
	{
		return $this->hasMany(EntCalificacionAlquimias::className(), ['id_post' => 'id_post']);
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCalificacionAlquimia()
	{
		return $this->hasOne(ViewCalificacionAlquimias::className(), ['id_post' => 'id_post']);
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdUsuarios()
	{
		return $this->hasMany(EntUsuarios::className(), ['id_usuario' => 'id_usuario'])->viaTable('ent_calificacion_alquimias', ['id_post' => 'id_post']);
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
	
	
	public function setEstrellas($numEstrellasEncendidas,$numEstrellas=ConstantesWeb::ESTRELLAS_MAXIMAS, $estrellasCalificadas=false){
		
	}
	
	/**
	 * Genera las estrellas
	 * 
	 * @param unknown $numEstrellas        	
	 * @param unknown $numEstrellasEncendidas        	
	 * @return string
	 */
	public function generarEstrellas($numEstrellasEncendidas, $numEstrellas=ConstantesWeb::ESTRELLAS_MAXIMAS, $estrellaCalificada=false) {
		$estrellas = '';
		// pinta n estrellas
		for($i = 1; $i <= $numEstrellas; $i ++) {
			$class = 'icon-star';
			if ($numEstrellasEncendidas < $i) {
				$class = 'icon-star-empty';
			}
			$estrellas .= '<i class="' . $class . '"></i>';
		}
		
		return $estrellas;
	}
	
	/**
	 * Actualiza la calificacion del usuario
	 * @param unknown $calificacion
	 * @return \app\models\EntAlquimias|NULL
	 */
	public function actualizarCalificacion($calificacion){
		$this->num_calificacion_admin = $calificacion;
		
		return $this->save()?$this:null;
	}
	
}
