<?php
use app\models\EntUsuariosRespuestasSabiasQue;
use yii\web\View;
use app\models\EntSabiasQue;
/* @var $post EntPosts*/

$validar = null;


if (! Yii::$app->user->isGuest) {
	$idUsuario = Yii::$app->user->identity->id_usuario;
	$validar = EntUsuariosRespuestasSabiasQue::find ()->where ( [
			'id_usuario' => $idUsuario
	] )->andWhere ( [
			'id_post' => $post->id_post
	] )->one ();
}
?>

<div class="pin pin-sabias-que" data-post="<?=$post->txt_token?>" id="js-sabias-que-pin-<?=$post->txt_token?>">
	<div class="pin-header pin-header-sabias-que"></div>
	<div class="image">
		<img data-src="webAssets/images/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>
		<?php 
		if($validar){
		?>
		<div class="pin-link">
			<a class="waves-effect waves-light btn btn-secondary"
				href="<?=$post->txt_url?>"
				target="_blank">Ver nota</a>
		</div>
		<?php 
		}
		?>
	</div>
	
	<?php
	
	if (! Yii::$app->user->isGuest) {
		
		$pregAdmin = EntSabiasQue::find ()->where ( [ 
				'id_post' => $post->id_post 
		] )->one ();
		
		
		if (! $validar) {
			?>
	
				<div class="switch pin-content-wrapper-switch">
		<form class="pin-sabias-que-form-checkbox">
			<p>
				<input name="group1" type="radio"
					id="test-false-<?=$post->txt_token?>" value="false"
					data-token="<?=$post->txt_token?>" class="js-respuesta-check"
					onclick="validarRespuesta($(this));" /> <label
					for="test-false-<?=$post->txt_token?>">Falso</label>
			</p>
			<p>
				<input name="group1" type="radio"
					id="test-true-<?=$post->txt_token?>" value="true"
					data-token="<?=$post->txt_token?>" class="js-respuesta-check"
					onclick="validarRespuesta($(this));" /> <label
					for="test-true-<?=$post->txt_token?>">Verdadero</label>
			</p>
		</form>
	</div>
	<?php
		} else if ($pregAdmin->b_verdadero == $validar->b_respuesta) {
			?>
						<p class="pin-sabias-que-respuesta-succes">Respondiste
		correctamente</p>
	<?php
		} else if ($pregAdmin->b_verdadero != $validar->b_respuesta) {
			?>
							<p class="pin-sabias-que-respuesta-error">Respondiste
		incorrectamente</p>
	<?php
		}
	} else if (Yii::$app->user->isGuest) {
		?>
				<div class="switch pin-content-wrapper-switch">
		<form class="pin-sabias-que-form-checkbox">
			<p>
				<input value="false" name="group1" type="radio" id="test1-<?=$post->txt_token?>"
					data-token="<?=$post->txt_token?>" type="checkbox" 
					class="js-respuesta-check" onclick="deshabilitarBotonSabias($(this));" />
				<label for="test1-<?=$post->txt_token?>">Falso</label>
			</p>
			<p>
				<input name="group1" value="true" type="radio" id="test2-<?=$post->txt_token?>"
					data-token="<?=$post->txt_token?>" type="checkbox" 
					class="js-respuesta-check" onclick="deshabilitarBotonSabias($(this));" />
				<label for="test2-<?=$post->txt_token?>">Verdadero</label>
			</p>
		</form>
	</div>

	<?php
	}
	// include 'elementos/pins-social.php';
	?>

	<!--?=$post->fch_creacion?-->
</div>
