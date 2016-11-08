<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_actions".
 *
 * @property integer $id_action
 * @property string $txt_action
 * @property string $txt_descripcion
 */
class EntActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_action', 'txt_descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_action' => 'Id Action',
            'txt_action' => 'Txt Action',
            'txt_descripcion' => 'Txt Descripcion',
        ];
    }
}
