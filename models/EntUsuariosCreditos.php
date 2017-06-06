<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_usuarios_creditos".
 *
 * @property integer $id_usuario
 * @property integer $numero_creditos
 * @property string $txt_descripcion
 */
class EntUsuariosCreditos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios_creditos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'numero_creditos', 'txt_descripcion'], 'required'],
            [['id_usuario', 'numero_creditos'], 'integer'],
            [['txt_descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'numero_creditos' => 'Numero Creditos',
            'txt_descripcion' => 'Txt Descripcion',
        ];
    }

    public function agregarCreditos($idUser, $tipoCredito, $descripcion='Se asignaron créditos'){
		$creditos = new EntUsuariosCreditos();
		$creditos->id_usuario = $idUser;
		$creditos->numero_creditos = $tipoCredito;
		$creditos->txt_descripcion = $descripcion;
		
        
        $creditos->save();
        return $creditos;
	}
}
