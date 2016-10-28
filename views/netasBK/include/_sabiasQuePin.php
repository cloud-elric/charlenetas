<?php
use app\models\EntUsuariosRespuestasSabiasQue;
use yii\web\View;
use app\models\EntSabiasQue;
/* @var $post EntPosts*/
?>

<div class="pin pin-sabias-que" data-post="<?=$post->txt_token?>">
	<div class="pin-header"></div>
	<div class="image">
		<img data-src="webAssets/images/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>
		<a href="<?=$post->txt_url?>"></a>
	</div>
	
	<?php 
		
		if(!Yii::$app->user->isGuest){
			$idUsuario = Yii::$app->user->identity->id_usuario;
			
			$sabiasQue = new EntSabiasQue();
			$pregAdmin = $sabiasQue->find()->where(['id_post'=>$post->id_post])->one();
			
			$respuesta = new EntUsuariosRespuestasSabiasQue();
			$validar = $respuesta->find()->where(['id_usuario'=>$idUsuario])->andWhere(['id_post'=>$post->id_post])->one();
			if($validar == false){	
	?>
	
				<div class="switch pin-content-wrapper-switch">
					<form>
						<p>
	      					<input name="group1" type="radio" id="test1" value="false" data-token="<?=$post->txt_token?>" class="js-respuesta-check" onclick="validarRespuesta($(this));"/>
			    	  		<label for="test1">Falso</label>
	    				</p>
		    			<p>
		      				<input name="group1" type="radio" id="test2" value="true" data-token="<?=$post->txt_token?>" class="js-respuesta-check" onclick="validarRespuesta($(this));"/>
	    	  				<label for="test2">Verdadero</label>
	    				</p>
  					</form>
				</div>
	<?php 	
			}else if($pregAdmin->b_verdadero == $validar->b_respuesta){
	?>
						<p>Respondiste correctamente</p>
	<?php
			}else if($pregAdmin->b_verdadero != $validar->b_respuesta){
	?>
							<p>Respondiste incorrectamente</p>
	<?php 
			}
		}else if(Yii::$app->user->isGuest){
	?>
				<div class="switch pin-content-wrapper-switch">
					<form>
						<p>
	      					<input name="group1" type="radio" id="test1" data-token="<?=$post->txt_token?>" type="checkbox" class="js-respuesta-check" onclick="validarRespuesta($(this));"/>
			      			<label for="test1">Falso</label>
		    			</p>
		    			<p>
	    	  				<input name="group1" type="radio" id="test2" data-token="<?=$post->txt_token?>" type="checkbox" class="js-respuesta-check" onclick="validarRespuesta($(this));"/>
	      					<label for="test2">Verdadero</label>
	    				</p>
  					</form>
  				</div>

	<?php
		}
		#include 'elementos/pins-social.php';
	?>

	<!--?=$post->fch_creacion?-->
</div>
