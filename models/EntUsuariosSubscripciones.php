<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_usuarios_subscripciones".
 *
 * @property string $id_post
 * @property string $id_usuario
 *
 * @property EntEspejos $idPost
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntUsuariosSubscripciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios_subscripciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'id_usuario'], 'required'],
            [['id_post', 'id_usuario'], 'integer'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntEspejos::className(), 'targetAttribute' => ['id_post' => 'id_post']],
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
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
