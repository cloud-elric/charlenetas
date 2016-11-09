<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_usuarios_creditos_gastados".
 *
 * @property integer $id_usuario
 * @property integer $creditos_gastados
 * @property string $txt_descripcion
 */
class EntUsuariosCreditosGastados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios_creditos_gastados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'creditos_gastados', 'txt_descripcion'], 'required'],
            [['id_usuario', 'creditos_gastados'], 'integer'],
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
            'creditos_gastados' => 'Creditos Gastados',
            'txt_descripcion' => 'Txt Descripcion',
        ];
    }
    
    /**
     * guarda en la BD el gasto que hace el usuario
     */
    public function guardarCreditosGastados($creditosGastados, $id_usuario, $gasto){
    	$creditosGastados->id_usuario = $id_usuario;
    	$creditosGastados->creditos_gastados = $gasto;
    	$creditosGastados->txt_descripcion = "Se ha hecho una cita";
    	
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($creditosGastados->save()) {
 
    			$transaction->commit();
    			return true;
    		}
    	$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	return false;
    }
}
