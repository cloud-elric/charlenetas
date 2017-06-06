<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "2gom_con_products".
 *
 * @property string $id_product
 * @property string $txt_name
 * @property string $txt_product_number
 * @property string $txt_desc
 * @property double $num_price
 * @property string $num_order
 * @property integer $b_enabled
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '2gom_con_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_name', 'txt_product_number', 'txt_desc', 'num_price', 'num_order'], 'required'],
            [['num_price'], 'number'],
            [['num_order', 'b_enabled'], 'integer'],
            [['txt_name'], 'string', 'max' => 100],
            [['txt_product_number'], 'string', 'max' => 51],
            [['txt_desc'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'txt_name' => 'Txt Name',
            'txt_product_number' => 'Txt Product Number',
            'txt_desc' => 'Txt Desc',
            'num_price' => 'Num Price',
            'num_order' => 'Num Order',
            'b_enabled' => 'B Enabled',
        ];
    }
}
