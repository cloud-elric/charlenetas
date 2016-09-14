<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\modAdminPanel\assets\ModuleAsset;

$this->title = 'Ingresar';
$this->params ['breadcrumbs'] [] = $this->title;

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/login.js'; // dynamic file added

?>
<div class="loader">
	<img src="<?=Yii::getAlias('@webroot')?>/adminPanel/web/imgs/loader.gif" alt="Loader">
</div>
<div class="wrap">
	<div class="login">
		<div class="login-cont">
			<div class="login-logo">
				<img src="<?=Yii::getAlias('@webroot')?>/adminPanel/web/imgs/charlenetas.png">
			</div>
			<div class="login-form">
				<h2 class="titulo"><?= Html::encode($this->title) ?></h2>
						 <?php
							$form = ActiveForm::begin ( [ 
									'options' => [ 
											'class' => 'form-login' 
									],
									'layout' => 'horizontal',
									'id' => 'login-form',
									'fieldConfig' => [ 
											'template' => "<div class='row'><div class='input-field col s12'>{input}</div>\n{label}\n{error}</div>",
											'horizontalCssClasses' => [ 
													'error' => 'mdl-textfield__error' 
											],
											'labelOptions' => [ 
													'class' => 'mdl-textfield__label' 
											],
											'options' => [ 
													'class' => 'input-field col s12' 
											] 
									],
									'errorCssClass' => 'invalid' 
							] );
							?>
									 <?= $form->field($model, 'username')->textInput(['autofocus' => true])?>
									<?= $form->field($model, 'password')->passwordInput()?>
					<div class="col s12 right-align">
									<?= Html::submitButton('Login <i class="material-icons right">send</i>',['class'=>'btn waves-effect waves-light center', 'name' => 'login-button', 'data-style'=>'"zoom-in'])?>
								</div>
				</div>
						<?php ActiveForm::end(); ?>
						<!-- <p class="datos"><a href="" class="crear-cuenta">Crear cuenta</a></p> -->
				<p class="datos">
					<a href="" class="olvide-pass">Olvide contraseña</a>
				</p>
			</div>
			<!-- <div class="login-foter"><img src="assets/imgs/power-by-2geeks.png"></div> -->
		</div>
	</div>
</div>








