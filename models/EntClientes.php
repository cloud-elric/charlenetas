<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_clientes".
 *
 * @property string $id_cliente
 * @property string $txt_nombre
 * @property string $txt_apellido
 * @property string $txt_correo
 * @property string $num_telefono
 */
class EntClientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre', 'txt_correo', 'num_telefono'], 'required'],
            [['num_telefono'], 'integer'],
            [['txt_nombre', 'txt_apellido', 'txt_correo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'txt_nombre' => 'Txt Nombre',
            'txt_apellido' => 'Txt Apellido',
            'txt_correo' => 'Txt Correo',
            'num_telefono' => 'Num Telefono',
        ];
    }
}
