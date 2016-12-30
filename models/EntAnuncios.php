<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_anuncios".
 *
 * @property string $id_anuncio
 * @property string $id_cliente
 * @property string $txt_imagen
 * @property string $txt_descripcion
 * @property string $fch_creacion
 * @property string $fch_finalizacion
 * @property integer $b_habilitado
 * @property integer $b_activo
 *
 * @property EntClientes $idCliente
 */
class EntAnuncios extends \yii\db\ActiveRecord
{
	public $imagen;
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_anuncios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'txt_imagen'], 'required'],
            [['id_cliente', 'b_habilitado', 'b_activo'], 'integer'],
            [['fch_creacion', 'fch_finalizacion'], 'safe'],
            [['txt_imagen', 'txt_descripcion'], 'string', 'max' => 60],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => EntClientes::className(), 'targetAttribute' => ['id_cliente' => 'id_cliente']],
        	[['imagen'],'image', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_anuncio' => 'Id Anuncio',
            'id_cliente' => 'Id Cliente',
            'txt_imagen' => 'Txt Imagen',
            'txt_descripcion' => 'Txt Descripcion',
            'fch_creacion' => 'Fch Creacion',
            'fch_finalizacion' => 'Fch Finalizacion',
            'b_habilitado' => 'B Habilitado',
            'b_activo' => 'B Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(EntClientes::className(), ['id_cliente' => 'id_cliente']);
    }
    
    public function cargarImagenAnuncio($anuncio) {
    	$anuncio->imagen->saveAs ( Yii::$app->params ['modAdmin'] ['path_imagenes_anuncios'] . $anuncio->txt_imagen );
    	return true;
    }
}
