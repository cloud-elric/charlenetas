<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "2gom_pay_ordenes_compras".
 *
 * @property string $id_orden_compra
 * @property string $txt_order_number
 * @property string $txt_description
 * @property string $id_cupon
 * @property string $id_usuario
 * @property string $id_payment_type
 * @property string $id_producto
 * @property string $fch_creacion
 * @property string $b_pagado
 * @property double $num_sub_total
 * @property double $num_total
 * @property string $b_habilitado
 *
 * @property Products $idProducto
 * @property PayCatPaymentsTypes $idPaymentType
 * @property PayCupons $idCupon
 * @property EntUsuarios $idUsuario
 * @property PayPaymentsRecibed[] $PayPaymentsRecibeds
 */
class PayOrdenesCompras extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '2gom_pay_ordenes_compras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_order_number', 'txt_description', 'id_usuario', 'fch_creacion', 'b_pagado', 'num_sub_total', 'num_total', 'b_habilitado'], 'required'],
            [['id_cupon', 'id_usuario', 'id_payment_type', 'id_producto', 'b_pagado', 'b_habilitado'], 'integer'],
            [['fch_creacion'], 'safe'],
            [['num_sub_total', 'num_total'], 'number'],
            [['txt_order_number'], 'string', 'max' => 50],
            [['txt_description'], 'string', 'max' => 500],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_producto' => 'id_product']],
            [['id_payment_type'], 'exist', 'skipOnError' => true, 'targetClass' => PayCatPaymentsTypes::className(), 'targetAttribute' => ['id_payment_type' => 'id_payment_type']],
            [['id_cupon'], 'exist', 'skipOnError' => true, 'targetClass' =>PayCupons::className(), 'targetAttribute' => ['id_cupon' => 'id_cupon']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_orden_compra' => 'Id Orden Compra',
            'txt_order_number' => 'Txt Order Number',
            'txt_description' => 'Txt Description',
            'id_cupon' => 'Id Cupon',
            'id_usuario' => 'Id Usuario',
            'id_payment_type' => 'Id Payment Type',
            'id_producto' => 'Id Producto',
            'fch_creacion' => 'Fch Creacion',
            'b_pagado' => 'B Pagado',
            'num_sub_total' => 'Num Sub Total',
            'num_total' => 'Num Total',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'id_producto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPaymentType()
    {
        return $this->hasOne(PayCatPaymentsTypes::className(), ['id_payment_type' => 'id_payment_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCupon()
    {
        return $this->hasOne(PayCupons::className(), ['id_cupon' => 'id_cupon']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(EntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get2gomPayPaymentsRecibeds()
    {
        return $this->hasMany(PayPaymentsRecibed::className(), ['id_orden_compra' => 'id_orden_compra']);
    }
}
