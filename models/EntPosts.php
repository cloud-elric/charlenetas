<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

use yii\data\ActiveDataProvider;

use app\modules\ModUsuarios\models\Utils;


/**
 * This is the model class for table "ent_posts".
 *
 * @property string $id_post
 * @property string $id_tipo_post
 * @property string $id_usuario
 * @property string $id_usuario_administrador
 * @property string $txt_titulo
 * @property string $txt_descripcion
 * @property string $txt_imagen
 * @property string $txt_token
 * @property string $txt_url
 * @property string $num_likes
 * @property string $fch_creacion
 * @property string $fch_publicacion
 * @property string $b_habilitado
 *
 * @property EntAlquimias $entAlquimias
 * @property EntComentariosPosts[] $entComentariosPosts
 * @property EntContextos $entContextos
 * @property EntEspejos $entEspejos
 * @property EntSabiasQue $entSabiasQue
 * @property CatTiposPosts $idTipoPost
 * @property EntUsuarios $idUsuario
 * @property EntSoloPorHoys $entSoloPorHoys
 * @property EntUsuariosLikePost[] $entUsuariosLikePosts
 * @property ModUsuariosEntUsuarios[] $idUsuarios
 */
class EntPosts extends \yii\db\ActiveRecord {
	private $_comentariosCount;
	public $tipoPost;
	public $imagen;
	

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_posts';
    }
    
    /**
     * POSTS_MOSTRAR es constante tiene un valor de 10
     * @param number $page=0
     * @param number $post: numero del tipo de post
     * @param unknown $pageSize
     */
    public static function getPosts($page = 0, $post , $pageSize = ConstantesWeb::POSTS_MOSTRAR){
    
    	/**
    	 * Busca en la base de datos EntPost donde id_tipo_post sea igual al valor de $post
    	 * @var \yii\db\ActiveQuery $query
    	 */
    	$query = EntPosts::find()->where(["id_tipo_post"=>$post]);
    
    	// Carga el dataprovider
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			//'sort'=> ['defaultOrder' => ['fch_publicacion'=>'asc']],
    			'pagination' => [
    					'pageSize' => $pageSize,
    					'page' => $page
    			]
    	]);
    
    	return $dataProvider->getModels();
    }
    
    
    /**
     * Busca un post por su token
     *
     * @param unknown $token
     * @throws NotFoundHttpException
     * @return EntPostsExtend
     */
    public static function getPostByToken($token) {
    	if (($post = EntPostsExtend::getPostByToken ( $token )) !== null) {
    		return $post;
    	} else {
    		throw new NotFoundHttpException ( 'The requested page does not exist.' );
    	}
    }
    


	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'imagen' 
						],
						'image',
						'skipOnEmpty' => false,
						'extensions' => 'png, jpg',
						'minWidth' => 300,
						'maxWidth' => 300,
						'minHeight' => 300,
						'maxHeight' => 300,
						'on' => 'crear' 
				],
				[ 
						[ 
								'id_tipo_post',
								'txt_descripcion' 
						],
						'required' 
				],
				[ 
						[ 
								'id_tipo_post',
								'id_usuario',
								'id_usuario_administrador',
								'num_likes',
								'b_habilitado' 
						],
						'integer' 
				],
				[ 
						[ 
								'txt_descripcion' 
						],
						'string' 
				],
				[ 
						[ 
								'fch_creacion',
								'fch_publicacion' 
						],
						'safe' 
				],
				[ 
						[ 
								'txt_titulo',
								'txt_imagen' 
						],
						'string',
						'max' => 100 
				],
				[ 
						[ 
								'txt_url' 
						],
						'string',
						'max' => 256 
				],
				[ 
						[ 
								'id_tipo_post' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => CatTiposPosts::className (),
						'targetAttribute' => [ 
								'id_tipo_post' => 'id_tipo_post' 
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
				'id_tipo_post' => 'Id Tipo Post',
				'id_usuario' => 'Id Usuario',
				'id_usuario_administrador' => 'Id Usuario Administrador',
				'txt_titulo' => 'Txt Titulo',
				'txt_descripcion' => 'Txt Descripcion',
				'txt_imagen' => 'Txt Imagen',
				'txt_url' => 'Txt Url',
				'num_likes' => 'Num Likes',
				'fch_creacion' => 'Fch Creacion',
				'fch_publicacion' => 'Fch Publicacion',
				'b_habilitado' => 'B Habilitado' 
		];
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntAlquimias() {
		return $this->hasOne ( EntAlquimias::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntSabiasQue() {
		return $this->hasOne ( EntSabiasQue::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntUsuariosLikePosts() {
		return $this->hasMany ( EntUsuariosLikePost::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntRespuestasEspejo() {
		return $this->hasOne ( EntRespuestasEspejo::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntComentariosPosts() {
		return $this->hasMany ( EntComentariosPosts::className (), [ 
				'id_post' => 'id_post' 
		] )->where ( [ 
				'is',
				'id_comentario_padre',
				null 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntContextos() {
		return $this->hasOne ( EntContextos::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntEspejos() {
		return $this->hasOne ( EntEspejos::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdTipoPost() {
		return $this->hasOne ( CatTiposPosts::className (), [ 
				'id_tipo_post' => 'id_tipo_post' 
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
	public function getIdUsuarioAdmin() {
		return $this->hasOne ( EntUsuarios::className (), [ 
				'id_usuario' => 'id_usuario_administrador' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntSoloPorHoys() {
		return $this->hasOne ( EntSoloPorHoys::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getViewContadorLikes() {
		return $this->hasOne ( ViewContadorLikes::className (), [ 
				'id_post' => 'id_post' 
		] );
	}
	
	/**
	 * Coloca comentarios contador
	 * 
	 * @param unknown $count        	
	 */
	public function setComentariosCount($count) {
		$this->_comentariosCount = ( int ) $count;
	}
	
	/**
	 * Obtiene los comentarios contador
	 * 
	 * @return NULL
	 */
	public function getComentariosCount() {
		if ($this->isNewRecord) {
			return null; // This avoid calling a query searching for null primary keys.
		}
		
		if ($this->_comentariosCount === null) {
			$this->setComentariosCount ( count ( $this->entComentariosPosts ) );
		}
		
		return $this->_comentariosCount;
	}
	
	/**
	 * Actualiza el numero de likes del post
	 * 
	 * @param unknown $numLikes        	
	 */
	public function actualizarNumLikes($numLikes) {
		$this->num_likes = $numLikes;
		$this->save ();
	}
	
	/**
	 * Guarda la alquimia y el post
	 * @param EntAlquimia $alquimia
	 * @param EntPosts $post
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarAlquimia($alquimia, $post) {
		$post->id_tipo_post = ConstantesWeb::POST_TYPE_ALQUIMIA;
		$post->fch_creacion = Utils::getFechaActual ();
		$post->txt_token = Utils::generateToken ( 'post' );
		
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($post->save ()) {
				
				if ($alquimia->save ()) {
					
					$transaction->commit ();
					return true;
				}
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Guarda post de Verdadazo
	 * @param EntPost $verdadazo
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarVerdadazos($verdadazo) {
		$verdadazo->id_tipo_post = ConstantesWeb::POST_TYPE_VERDADAZOS;
		$verdadazo->fch_creacion = Utils::getFechaActual ();
		$verdadazo->txt_token = Utils::generateToken ( 'post' );
	
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($verdadazo->save ()) {
						
				$transaction->commit ();
				return true;	
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
	
		return false;
	}
	
	/**
	 * Guarda post de Hoy Pense
	 * @param EntPost $hoyPense
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarHoyPense($hoyPense) {
		$hoyPense->id_tipo_post = ConstantesWeb::POST_TYPE_HOY_PENSE;
		$hoyPense->fch_creacion = Utils::getFechaActual ();
		$hoyPense->txt_token = Utils::generateToken ( 'post' );
	
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($hoyPense->save ()) {
	
				$transaction->commit ();
				return true;
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
	
		return false;
	}
	
	/**
	 * Guarda post de Media
	 * @param EntPost $media
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarMedia($media) {
		$media->id_tipo_post = ConstantesWeb::POST_TYPE_MEDIA;
		$media->fch_creacion = Utils::getFechaActual ();
		$media->txt_token = Utils::generateToken ( 'post' );
	
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($media->save ()) {
	
				$transaction->commit ();
				return true;
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
	
		return false;
	}
	
	/**
	 * Guarda el contexto y el post
	 * @param EntContexto $contexto
	 * @param EntPosts $post
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarContexto($contexto, $post) {
		$post->id_tipo_post = ConstantesWeb::POST_TYPE_CONTEXTO;
		$post->fch_creacion = Utils::getFechaActual ();
		$post->txt_token = Utils::generateToken ( 'post' );
	
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($post->save ()) {
	
				if ($contexto->save ()) {
						
					$transaction->commit ();
					return true;
				}
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
	
		return false;
	}
	
	/**
	 * Guarda el solo por hoy y el post
	 * @param EntSoloPorHoys $soloporhoy
	 * @param EntPosts $post
	 * @throws Exception
	 * @return boolean
	 */
	public function guardarSoloPorHoy($soloporhoy, $post) {
		$post->id_tipo_post = ConstantesWeb::POST_TYPE_SOLO_POR_HOY;
		$post->fch_creacion = Utils::getFechaActual ();
		$post->txt_token = Utils::generateToken ( 'post' );
	
		$transaction = EntPosts::getDb ()->beginTransaction ();
		try {
			if ($post->save ()) {
	
				if ($soloporhoy->save ()) {
	
					$transaction->commit ();
					return true;
				}
			}
			$transaction->rollBack ();
		} catch ( \Exception $e ) {
			$transaction->rollBack ();
			throw $e;
		}
	
		return false;
	}

}
