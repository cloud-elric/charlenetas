<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\Utils;

/**
 * This is the model class for table "ent_citas".
 *
 * @property string $id_cita
 * @property string $id_usuario
 * @property string $txt_token
 * @property string $fch_cita
 * @property string $hra_cita
 * @property string $b_habilitado
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
            [['id_usuario', 'txt_token'], 'required'],
            [['id_usuario', 'b_habilitado'], 'integer'],
            [['fch_cita', 'hra_cita'], 'safe'],
            [['txt_token'], 'string', 'max' => 60],
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
            'txt_token' => 'Txt Token',
            'fch_cita' => 'Fch Cita',
            'hra_cita' => 'Hra Cita',
            'b_habilitado' => 'B Habilitado',
        ];
    }
    
    /**
     * Guarda las citas que crea el usuario
     * @param unknown $cita EntCitas
     */
    public function guardarCitas($cita){
    	
    	$cita->id_usuario = 26;//Yii::$app->user->identity;
    	$cita->txt_token = Utils::generateToken ( 'cita_' );
    	
    	$citas = new EntCitas();
    	$comparar = $citas->find()->where(['hra_cita'=>$cita->hra_cita])->andWhere(['fch_cita'=>$cita->fch_cita])->one();
    	
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	
    	if($comparar == false){
    		try {
    			if ($cita->save()) {
    			 
    				$transaction->commit();
    				return $cita;
    			}
    			//print_r($cita->errors);
    			//exit();
    			$transaction->rollBack ();
    		} catch ( \Exception $e ) {
    			$transaction->rollBack ();
    			throw $e;
    		}
    	} else {
    		echo "Ya hay una cita a esa hora  ";
    	}
    	 
    	return false;
    }
}
