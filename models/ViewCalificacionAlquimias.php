<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_calificacion_alquimias".
 *
 * @property string $id_post
 * @property string $num_calificacion
 */
class ViewCalificacionAlquimias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_calificacion_alquimias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post'], 'required'],
            [['id_post'], 'integer'],
            [['num_calificacion'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'num_calificacion' => 'Num Calificacion',
        ];
    }
}
