<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "2gom_pay_cupons".
 *
 * @property string $id_cupon
 * @property string $txt_identificador_unico
 * @property string $txt_descripcion
 * @property string $num_porcentaje_descuento
 * @property string $num_cupones
 * @property string $b_grupo
 * @property string $b_porcentaje
 * @property string $fch_inicio
 * @property string $fch_final
 * @property string $b_usado
 *
 * @property PayOrdenesCompras[] $PayOrdenesCompras
 */
class PayCupons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '2gom_pay_cupons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_identificador_unico', 'txt_descripcion', 'num_porcentaje_descuento', 'num_cupones', 'fch_inicio', 'fch_final'], 'required'],
            [['num_porcentaje_descuento', 'num_cupones', 'b_grupo', 'b_porcentaje', 'b_usado'], 'integer'],
            [['fch_inicio', 'fch_final'], 'safe'],
            [['txt_identificador_unico', 'txt_descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cupon' => 'Id Cupon',
            'txt_identificador_unico' => 'Txt Identificador Unico',
            'txt_descripcion' => 'Txt Descripcion',
            'num_porcentaje_descuento' => 'Num Porcentaje Descuento',
            'num_cupones' => 'Num Cupones',
            'b_grupo' => 'B Grupo',
            'b_porcentaje' => 'B Porcentaje',
            'fch_inicio' => 'Fch Inicio',
            'fch_final' => 'Fch Final',
            'b_usado' => 'B Usado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayOrdenesCompras()
    {
        return $this->hasMany(PayOrdenesCompras::className(), ['id_cupon' => 'id_cupon']);
    }
}
