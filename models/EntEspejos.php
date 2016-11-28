<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_espejos".
 *
 * @property string $id_post
 * @property string $num_subscriptores
 *
 * @property EntPosts $idPost
 * @property EntRespuestasEspejo $entRespuestasEspejo
 * @property EntUsuariosSubscripciones $entUsuariosSubscripciones
 */
class EntEspejos extends \yii\db\ActiveRecord
{
	
	private $_subscriptoresCount;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_espejos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post'], 'required'],
            [['num_subscriptores'], 'integer'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntPosts::className(), 'targetAttribute' => ['id_post' => 'id_post']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'num_subscriptores' => 'Num Subscriptores',
        	'b_anonimo'=>'Publicar pregunta como anonimo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntPosts::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestasEspejo()
    {
        return $this->hasOne(EntRespuestasEspejo::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntUsuariosSubscripciones()
    {
        return $this->hasMany(EntUsuariosSubscripciones::className(), ['id_post' => 'id_post']);
    }
    
    /**
     * Coloca hot contador
     * @param unknown $count
     */
    public function setHotCount($count)
    {
    	$this->_subscriptoresCount = (int) $count;
    }
    
    /**
     * Obtiene los hot contador
     * @return NULL
     */
    public function getHotCount()
    {
    	if ($this->isNewRecord) {
    		return null; // This avoid calling a query searching for null primary keys.
    	}
    
    	if ($this->_subscriptoresCount === null) {
    		$this->setHotCount(count($this->entUsuariosSubscripciones));
    	}
    
    	return $this->_subscriptoresCount;
    }
}
