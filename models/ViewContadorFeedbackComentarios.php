<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_contador_feedback_comentarios".
 *
 * @property string $num_usuarios
 * @property string $id_comentario
 * @property string $id_tipo_feedback
 */
class ViewContadorFeedbackComentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_contador_feedback_comentarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_usuarios', 'id_comentario', 'id_tipo_feedback'], 'integer'],
            [['id_comentario', 'id_tipo_feedback'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'num_usuarios' => 'Num Usuarios',
            'id_comentario' => 'Id Comentario',
            'id_tipo_feedback' => 'Id Tipo Feedback',
        ];
    }
}
