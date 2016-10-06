<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "citas".
 *
 * @property integer $id_cita
 * @property string $titulo
 * @property string $descripcion
 * @property string $fch_creacion
 */
class Citas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'citas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fch_creacion'], 'safe'],
            [['titulo'], 'string', 'max' => 40],
            [['descripcion'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cita' => 'Id Cita',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fch_creacion' => 'Fch Creacion',
        ];
    }
}
