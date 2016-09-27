<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_sabias_que".
 *
 * @property string $id_post
 * @property integer $b_verdadero
 *
 * @property EntPosts $idPost
 * @property EntUsuariosRespuestasSabiasQue[] $entUsuariosRespuestasSabiasQues
 * @property ModUsuariosEntUsuarios[] $idUsuarios
 */
class EntSabiasQue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_sabias_que';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post'], 'integer'],
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
            'b_verdadero' => 'Respuesta',
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
    public function getEntUsuariosRespuestasSabiasQues()
    {
        return $this->hasMany(EntUsuariosRespuestasSabiasQue::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarios()
    {
        return $this->hasMany(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario'])->viaTable('ent_usuarios_respuestas_sabias_que', ['id_post' => 'id_post']);
    }
}
