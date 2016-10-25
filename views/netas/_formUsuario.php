<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\VistaTotalCreditos;
use app\models\EntComentariosPosts;
?>

<h4><span>Informacion de Usuario</span></h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
 		
		'layout' => 'horizontal',
		'id' => 'editar-usuario',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label '
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
	<div class='row'>

		<?= $form->field($usuario, 'txt_username')->textInput(['maxlength' => true])?>

		<?= $form->field($usuario, 'txt_apellido_paterno')->textInput(['maxlength' => true])?>

		<?= $form->field($usuario, 'txt_apellido_materno')->textInput(['maxlength' => true])?>
		
		<?= $form->field($usuario, 'txt_email')->textInput(['maxlength' => true])?>
		
	</div>

	<?= Html::submitButton('<span class="ladda-label">Crear</span>',['id'=>'js-editar-submit-usuario', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name'=>'boton-usuario', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();

$idUsuario = Yii::$app->user->identity->id_usuario;

//creditos
$creditosTotales = new VistaTotalCreditos();
$total = $creditosTotales->find()->where(['id_usuario'=>$idUsuario])->one();

//comentarios
$comentarios = new EntComentariosPosts();
$comentariosMostrar = $comentarios->find()->where(['id_usuario'=>$idUsuario])->orderBy(['id_comentario_post'=>'ASC'])->limit(5)->all();
?>

<p>Numero de creditos disponibles: <?= $total->num_total_creditos?></p>

<p>Ultimos 5 comentarios realizados</p>
<?php 
	foreach($comentariosMostrar as $com){
		echo $com->txt_comentario;
		echo "<br>";
		echo $com->fch_comentario;
		echo "<br>";
		echo "<br>";
	}
?>

