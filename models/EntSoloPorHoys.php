<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_solo_por_hoys".
 *
 * @property string $id_post
 * @property string $num_articulo
 *
 * @property EntPosts $idPost
 */
class EntSoloPorHoys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_solo_por_hoys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post'], 'required'],
            [['id_post', 'num_articulo'], 'integer'],
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
            'num_articulo' => 'Num Articulo',
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
