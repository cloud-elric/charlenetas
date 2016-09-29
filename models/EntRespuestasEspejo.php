<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\modules\ModUsuarios\models\Utils;

/**
* This is the model class for table "ent_respuestas_espejo".
*
* @property string $id_post
* @property string $id_usuario_admin 
* @property string $txt_respuesta
* @property string $fch_respuesta
* @property string $fch_publicacion_respuesta
* @property string $b_de_acuerdo
*
* @property EntUsuarios $idUsuarioAdmin 
* @property EntEspejos $idPost
*/
class EntRespuestasEspejo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_respuestas_espejo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'txt_respuesta', 'fch_publicacion_respuesta'], 'required'],
            [['id_post', 'b_de_acuerdo'], 'integer'],
            [['txt_respuesta'], 'string'],
            [['fch_respuesta', 'fch_publicacion_respuesta'], 'safe'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntEspejos::className(), 'targetAttribute' => ['id_post' => 'id_post']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'txt_respuesta' => 'Respuesta',
            'fch_respuesta' => 'Fch Respuesta',
            'fch_publicacion_respuesta' => 'Fecha de publicación Respuesta',
            'b_de_acuerdo' => 'B De Acuerdo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntEspejos::className(), ['id_post' => 'id_post']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioAdmin()
    {
    	return $this->hasOne(EntUsuarios::className(), ['id_usuario' => 'id_usuario_admin']);
    }
    
    /**
     * Guarda la respuesta
     * @param EntRespuestasEspejo $respuesta
     * @return \app\models\EntRespuestasEspejo|NULL
     */
    public function guardarRespuesta($respuesta){
    	// usuario logueado
    	$respuesta->id_usuario_admin = Yii::$app->user->identity->id_usuario;
    	$respuesta->fch_respuesta = Utils::getFechaActual();
    	$respuesta->fch_publicacion_respuesta = Utils::changeFormatDateInput($respuesta->fch_publicacion_respuesta);
    	
    	return $this->save()?$this:null;
    }
}
