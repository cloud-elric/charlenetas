<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\Utils;

/**
 * This is the model class for table "ent_citas".
 *
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $id_usuario
 * @property string $txt_token
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
            [['title', 'id_usuario', 'txt_token'], 'required'],
            [['id_usuario', 'b_habilitado'], 'integer'],
            [['start', 'end'], 'safe'],
            [['title', 'txt_token'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'id_usuario' => 'Id Usuario',
            'txt_token' => 'Txt Token',
            'b_habilitado' => 'B Habilitado',
        ];
    }
    
    /**
     * Guarda las citas que crea el usuario
     * @param unknown $cita EntCitas
    
    public function guardarCitas($title, $start, $end){
    	$cita = new EntCitas();
    	
    	$cita->title = $title;
    	$cita->start = $start;
    	$ciya->end = $end;
    	$cita->id_usuario = 26;//Yii::$app->user->identity;
    	$cita->txt_token = Utils::generateToken ( 'cita_' );
    	
    	$citas = new EntCitas();
    	$comparar = $citas->find()->where(['start'=>$cita->start])->one();
    	
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
    } */
}
