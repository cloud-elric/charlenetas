<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_citas".
 *
 * @property string $id_cita
 * @property string $id_usuario
 * @property string $fch_creacion
 */
class EntCitas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_citas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['fch_creacion'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cita' => 'Id Cita',
            'id_usuario' => 'Id Usuario',
            'fch_creacion' => 'Fch Creacion',
        ];
    }
    
    /**
     * Guarda las citas que crea el usuario
     * @param unknown $cita EntCitas
     */
    public function guardarCitas($cita){
    	
    	$cita->id_usuario = Yii::$app->user->identity;
    	
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($cita->save()) {
    			 
    			$transaction->commit();
    			return true;
    		}
    		//print_r($cita->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	 
    	return false;
    }
}
