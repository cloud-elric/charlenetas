<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_contextos".
 *
 * @property string $id_post
 * @property string $id_contexto_padre
 * @property string $txt_tags
 *
 * @property EntContextos $idContextoPadre
 * @property EntContextos[] $entContextos
 * @property EntPosts $idPost
 */
class EntContextos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_contextos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'txt_tags'], 'required'],
            [['id_post', 'id_contexto_padre'], 'integer'],
            [['id_contexto_padre'], 'exist', 'skipOnError' => true, 'targetClass' => EntContextos::className(), 'targetAttribute' => ['id_contexto_padre' => 'id_post']],
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
            'id_contexto_padre' => 'Id Contexto Padre',
            'txt_tags' => 'Txt Tags',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContextoPadre()
    {
        return $this->hasOne(EntContextos::className(), ['id_post' => 'id_contexto_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntContextos()
    {
        return $this->hasMany(EntContextos::className(), ['id_contexto_padre' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntPosts::className(), ['id_post' => 'id_post']);
    }
}
