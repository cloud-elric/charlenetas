<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tipo_creditos".
 *
 * @property integer $id_credito
 * @property string $nombre
 * @property integer $costo
 */
class CatTipoCreditos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_tipo_creditos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'costo'], 'required'],
            [['costo'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_credito' => 'Id Credito',
            'nombre' => 'Nombre',
            'costo' => 'Costo',
        ];
    }
}
