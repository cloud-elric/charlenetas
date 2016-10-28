<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vista_total_creditos".
 *
 * @property string $USUARIO
 * @property string $TOTAL
 */
class VistaTotalCreditos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vista_total_creditos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USUARIO'], 'integer'],
            [['TOTAL'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USUARIO' => 'Usuario',
            'TOTAL' => 'Total',
        ];
    }
}
