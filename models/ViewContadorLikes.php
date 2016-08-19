<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_contador_likes".
 *
 * @property string $id_post
 * @property string $num_likes
 */
class ViewContadorLikes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_contador_likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post'], 'required'],
            [['id_post', 'num_likes'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'num_likes' => 'Num Likes',
        ];
    }
}
