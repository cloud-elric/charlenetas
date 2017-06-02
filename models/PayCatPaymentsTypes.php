<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "2gom_pay_cat_payments_types".
 *
 * @property string $id_payment_type
 * @property string $txt_name
 * @property string $txt_payment_type_number
 * @property string $txt_icon_url
 * @property integer $b_enabled
 *
 * @property 2gomPayOrdenesCompras[] $2gomPayOrdenesCompras
 * @property 2gomPayPaymentsRecibed[] $2gomPayPaymentsRecibeds
 */
class PayCatPaymentsTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '2gom_pay_cat_payments_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_name', 'txt_payment_type_number'], 'required'],
            [['b_enabled'], 'integer'],
            [['txt_name', 'txt_payment_type_number', 'txt_icon_url'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_payment_type' => 'Id Payment Type',
            'txt_name' => 'Txt Name',
            'txt_payment_type_number' => 'Txt Payment Type Number',
            'txt_icon_url' => 'Txt Icon Url',
            'b_enabled' => 'B Enabled',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayOrdenesCompras()
    {
        return $this->hasMany(PayOrdenesCompras::className(), ['id_payment_type' => 'id_payment_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayPaymentsRecibeds()
    {
        return $this->hasMany(PayPaymentsRecibed::className(), ['id_tipo_pago' => 'id_payment_type']);
    }
}
