<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_comentarios_posts".
 *
 * @property string $id_comentario_post
 * @property string $id_comentario_padre
 * @property string $id_post
 * @property string $id_usuario
 * @property string $txt_comentario
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 * @property EntComentariosPosts $idComentarioPadre
 * @property EntComentariosPosts[] $entComentariosPosts
 * @property EntPosts $idPost
 */
class EntComentariosPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_comentarios_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comentario_padre', 'id_post', 'id_usuario'], 'integer'],
            [['id_usuario', 'txt_comentario'], 'required'],
            [['txt_comentario'], 'string'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_comentario_padre'], 'exist', 'skipOnError' => true, 'targetClass' => EntComentariosPosts::className(), 'targetAttribute' => ['id_comentario_padre' => 'id_comentario_post']],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntPosts::className(), 'targetAttribute' => ['id_post' => 'id_post']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comentario_post' => 'Id Comentario Post',
            'id_comentario_padre' => 'Id Comentario Padre',
            'id_post' => 'Id Post',
            'id_usuario' => 'Id Usuario',
            'txt_comentario' => 'Txt Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdComentarioPadre()
    {
        return $this->hasOne(EntComentariosPosts::className(), ['id_comentario_post' => 'id_comentario_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntComentariosPosts()
    {
        return $this->hasMany(EntComentariosPosts::className(), ['id_comentario_padre' => 'id_comentario_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntPosts::className(), ['id_post' => 'id_post']);
    }
}
