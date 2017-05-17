<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_disponibilidades_tiempo".
 *
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $txt_token
 * @property string $b_habilitado
 */
class EntDisponibilidadesTiempo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_disponibilidades_tiempo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'txt_token'], 'required'],
            [['start', 'end'], 'safe'],
            [['b_habilitado'], 'integer'],
            [['title', 'txt_token'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'txt_token' => 'Txt Token',
            'b_habilitado' => 'B Habilitado',
        ];
    }
}
