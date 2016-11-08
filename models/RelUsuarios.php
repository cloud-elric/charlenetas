<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_usuarios".
 *
 * @property integer $id_tipo_usuario
 * @property integer $id_action
 *
 * @property EntActions $idAction
 */
class RelUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_usuario', 'id_action'], 'required'],
            [['id_tipo_usuario', 'id_action'], 'integer'],
            [['id_action'], 'exist', 'skipOnError' => true, 'targetClass' => EntActions::className(), 'targetAttribute' => ['id_action' => 'id_action']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'id_action' => 'Id Action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAction()
    {
        return $this->hasOne(EntActions::className(), ['id_action' => 'id_action']);
    }
}
