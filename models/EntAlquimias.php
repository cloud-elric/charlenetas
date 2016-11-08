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
 * @property EntUsuariosCalificacionAlquimia[] $entUsuariosCalificacionAlquimias
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
								'num_calificacion_admin' 
						],
						'required' 
				],
				[ 
						[ 
								'id_post',
								'num_calificacion_admin'
 								
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
				'num_calificacion_admin' => 'Calificación',
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
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntUsuariosCalificacionAlquimias()
	{
		return $this->hasMany(EntUsuariosCalificacionAlquimia::className(), ['id_post' => 'id_post']);
	}
	
	/**
	 * Genera un contenedor con estrellas 
	 * 
	 * @param unknown $numEstrellasEncendidas
	 * @param string $estrellasCalificadas
	 * @return string
	 */
	public function contenedorEstrellas($numEstrellasEncendidas, $token='', $estrellasCalificadas=false, $isOnClicked=false){
		$id = '';
		if($isOnClicked){
			$id = 'id="js-estrellas-usuario"';
		}
		
		$contenedorEstrellas = '<div '.$id.' class="star-wrapper '.($estrellasCalificadas?'calificable js-estrella-usuario':'').'" data-token="'.$token.'">';
		$contenedorEstrellas.=$this->generarEstrellas($numEstrellasEncendidas, ConstantesWeb::ESTRELLAS_MAXIMAS, $isOnClicked);
		$contenedorEstrellas.='</div>';
		return $contenedorEstrellas;		
	}
	
	/**
	 * Genera las estrellas
	 * 
	 * @param unknown $numEstrellas        	
	 * @param unknown $numEstrellasEncendidas        	
	 * @return string
	 */
	public function generarEstrellas($numEstrellasEncendidas, $numEstrellas=ConstantesWeb::ESTRELLAS_MAXIMAS, $isOnClicked=false) {
		$estrellas = '';
		$onclick = '';
		
		// pinta n estrellas
		for($i = 1; $i <= $numEstrellas; $i ++) {
			$class = 'icon-star';
			if ($numEstrellasEncendidas < $i) {
				$class.= ' icon-star-empty';
			}
			
			if($isOnClicked){
				$class.= ' star-clickeble';
				$onclick ='onclick=calificarPrenderEstrellas($(this))';
				
				if(Yii::$app->user->isGuest){
					$onclick = 'onclick="showModalLogin();"';
				}
				
			}
			
			$estrellas .= '<i class="' . $class . '" '.$onclick.' data-value="'.$i.'"></i>';
		}
		
		return $estrellas;
	}
	
	/**
	 * Actualiza la calificacion del usuario
	 * @param unknown $calificacion
	 * @return \app\models\EntAlquimias|NULL
	 */
	public function actualizarCalificacion($calificacion){
		$this->num_calificacion_usuario = $calificacion;
		
		return $this->save()?$this:null;
	}
	
}
