<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
$bundle = AppAsset::register ( Yii::$app->view );
$this->title = 'Cambiar contraseña';
?>

<div class="wrap">
	<div class="recovery-pass">
		<div class="login-cont">
			<div class="login-logo">
				<img src="<?=Url::base()?>/webAssets/images/logo-charlenetas.png">
			</div>
			<div class="login-form">
				<h2 class="titulo"><?= Html::encode($this->title) ?></h2>
						 <?php
							$form = ActiveForm::begin ( [ 
									'enableClientValidation' => true,
									'options' => [ 
											'class' => 'form-cambiar-pass' 
									],
									'layout' => 'horizontal',
									'id' => 'login-form',
									'fieldConfig' => [ 
											'template' => "{input}\n{label}\n{error}",
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
							<div>
									 <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true])?>

					<div class="col s12 right-align">
									<?= Html::submitButton('<span class="ladda-label">Cambiar contraseña</span>',['id'=>'js-submit-cambiar-pass', 'class'=>'btn waves-effect waves-light center ladda-button', 'name' => 'login-button', 'data-style'=>'zoom-in'])?>
								</div>
				</div>


			</div>
						<?php ActiveForm::end(); ?>
						<!-- <p class="datos"><a href="" class="crear-cuenta">Crear cuenta</a></p> -->
			<p class="datos">
				<!-- 				<a href="" class="olvide-pass">Olvide contraseña</a> -->
			</p>
		</div>
		<!-- <div class="login-foter"><img src="assets/imgs/power-by-2geeks.png"></div> -->
	</div>
</div>


<?php 
$this->registerJs ( "
 $('body').on(
		'beforeSubmit',
		'#login-form',
		function() {
			var button = document.getElementById('js-submit-cambiar-pass');
			var l  = Ladda.create(button);
			l.start();
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
			
			
		});

  ", View::POS_END );


?>