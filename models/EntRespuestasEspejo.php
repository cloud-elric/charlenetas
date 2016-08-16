<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_respuestas_espejo".
 *
 * @property string $id_post
 * @property string $txt_respuesta
 * @property string $fch_respuesta
 * @property string $fch_publicacion_respuesta
 * @property string $b_de_acuerdo
 *
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
            [['id_post', 'txt_respuesta'], 'required'],
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
            'txt_respuesta' => 'Txt Respuesta',
            'fch_respuesta' => 'Fch Respuesta',
            'fch_publicacion_respuesta' => 'Fch Publicacion Respuesta',
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
}
