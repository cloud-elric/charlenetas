<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $post EntPosts*/
?>

<div class="pin pin-espejo"
	onclick="showPostFull('<?=$post->txt_token?>')">

	<div class="pin-header pin-header-espejo"></div>

	<div class=image>
		<img src="<?=Url::base()?>/webAssets/images/espejo.jpg">
	</div>


	<div class="pin-content-wrapper" lang="en">
		<p class="pin-descripcion">
		<?=$post->txt_descripcion?>
	</p>
	</div>

	<div class="pin-social">

		<div class="pin-social-usr">
		<?php
		$usuario = $post->idUsuario;

		if (! empty ( $usuario )) {
			echo Html::img ( $usuario->getImageProfile());
			echo '<span>' . $usuario->txt_username . '</span>';
		}

		?>

	</div>
		<div class="pin-social-interactions">
			<span><?=$post->entEspejos->num_subscriptores?></span> <i
				class="icon icon-fire"></i>
		</div>

	</div>

</div>
