<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_alquimias".
 *
 * @property string $id_post
 * @property string $num_calificacion_admin
 * @property string $num_calificacion_usuario
 *
 * @property EntPosts $idPost
 */
class EntAlquimias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_alquimias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'num_calificacion_admin'], 'required'],
            [['id_post', 'num_calificacion_admin', 'num_calificacion_usuario'], 'integer'],
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
            'num_calificacion_admin' => 'Num Calificacion Admin',
            'num_calificacion_usuario' => 'Num Calificacion Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntPosts::className(), ['id_post' => 'id_post']);
    }
}
