<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\VistaTotalCreditos;
use app\models\EntComentariosPosts;
use app\models\EntPosts;
?>

	<script type="text/javascript" >
		function showPostFull(token) {
			var background = $('#backScreen');
			var content = $('#js-content');
			var url = 'http://localhost/charlenetas/web/netas/cargar-post?token=' + token;
	
			$('body').css('overflow', 'hidden');
	
			background.show();
			content.load(url, function() {
				//content.html('');
				//cargarComentarios(token, true);
			});
		}
	</script>

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
		
		<?= $form->field($usuario, 'imageProfile', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
		
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
$comentariosMostrar = $comentarios->find()->where(['id_usuario'=>$idUsuario])->orderBy('id_comentario_post DESC')->limit(5)->all();

//espejos
$espejos = new EntPosts();
$espejoMostar = $espejos->find()->where(['id_tipo_post'=>1])->andWhere(['id_usuario'=>$idUsuario])->orderBy('id_post DESC')->limit(5)->all();
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

<p>Ultimos 5 espejos relizados</p>

<?php 
	foreach($espejoMostar as $esp){
?>		
		<div onClick="showPostFull('<?=$esp->txt_token?>')">
			<?= "Pregunta realizada el dias " . $esp->fch_creacion;?>
			<br>
			<?= $esp->txt_descripcion;?>
			<br>
			<br>
		</div>
<?php } ?>

<div id="js-tmp" style="display: none;"></div>

<div id="backScreen">
	<div id="wrapper" style="height:100%">
		<i onclick="hidePostFull()" class="icon-close"></i>
		<div id="js-content" class="full-pin-content">
			<div style="
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    position: relative;
">
<div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>

  </div>
		
		</div>
	</div>
</div>
</div>
