<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tipos_usuarios".
 *
 * @property string $id_tipo_usuario
 * @property string $txt_nombre
 * @property string $txt_token
 * @property string $txt_descripcion
 * @property integer $b_habilitado
 *
 * @property ModUsuariosEntUsuarios[] $modUsuariosEntUsuarios
 */
class CatTiposUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_tipos_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_habilitado'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_token'], 'string', 'max' => 60],
            [['txt_descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'txt_nombre' => 'Txt Nombre',
            'txt_token' => 'Txt Token',
            'txt_descripcion' => 'Txt Descripcion',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntUsuarios()
    {
        return $this->hasMany(ModUsuariosEntUsuarios::className(), ['id_tipo_usuario' => 'id_tipo_usuario']);
    }
}
