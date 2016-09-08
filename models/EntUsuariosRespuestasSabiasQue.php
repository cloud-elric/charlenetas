<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_usuarios_respuestas_sabias_que".
 *
 * @property string $id_post
 * @property string $id_usuario
 * @property string $b_respuesta
 *
 * @property EntSabiasQue $idPost
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntUsuariosRespuestasSabiasQue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios_respuestas_sabias_que';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'id_usuario', 'b_respuesta'], 'required'],
            [['id_post', 'id_usuario', 'b_respuesta'], 'integer'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntSabiasQue::className(), 'targetAttribute' => ['id_post' => 'id_post']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'id_usuario' => 'Id Usuario',
            'b_respuesta' => 'B Respuesta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntSabiasQue::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
