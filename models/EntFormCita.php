<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_form_cita".
 *
 * @property string $id_form_cita
 * @property string $id_usuario
 * @property string $txt_sexo
 * @property string $txt_genero
 * @property string $txt_religion
 * @property string $txt_estado_civil
 * @property string $txt_edad
 * @property string $txt_nacionalidad
 * @property string $txt_domicilio
 * @property string $txt_palabra
 * @property string $txt_ocupacion
 * @property string $txt_pregunta
 * @property string $txt_final_pregunta
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntFormCita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_form_cita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['txt_sexo', 'txt_genero', 'txt_religion', 'txt_estado_civil', 'txt_edad', 'txt_nacionalidad', 'txt_palabra', 'txt_ocupacion'], 'string', 'max' => 100],
            [['txt_domicilio', 'txt_pregunta', 'txt_final_pregunta'], 'string', 'max' => 500],
            [['id_usuario'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_form_cita' => 'Id Form Cita',
            'id_usuario' => 'Id Usuario',
            'txt_sexo' => 'Txt Sexo',
            'txt_genero' => 'Txt Genero',
            'txt_religion' => 'Txt Religion',
            'txt_estado_civil' => 'Txt Estado Civil',
            'txt_edad' => 'Txt Edad',
            'txt_nacionalidad' => 'Txt Nacionalidad',
            'txt_domicilio' => 'Txt Domicilio',
            'txt_palabra' => 'Txt Palabra',
            'txt_ocupacion' => 'Txt Ocupacion',
            'txt_pregunta' => 'Txt Pregunta',
            'txt_final_pregunta' => 'Txt Final Pregunta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
