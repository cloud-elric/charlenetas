<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tipos_posts".
 *
 * @property string $id_tipo_post
 * @property string $txt_nombre
 * @property string $txt_descripcion
 * @property string $txt_color
 * @property string $txt_ico
 * @property string $b_habilitado
 *
 * @property EntPosts[] $entPosts
 */
class CatTiposPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_tipos_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre'], 'required'],
            [['b_habilitado'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_descripcion'], 'string', 'max' => 500],
            [['txt_color', 'txt_ico'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_post' => 'Id Tipo Post',
            'txt_nombre' => 'Txt Nombre',
            'txt_descripcion' => 'Txt Descripcion',
            'txt_color' => 'Txt Color',
            'txt_ico' => 'Txt Ico',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntPosts()
    {
        return $this->hasMany(EntPosts::className(), ['id_tipo_post' => 'id_tipo_post']);
    }
}
