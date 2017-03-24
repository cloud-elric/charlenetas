<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\EntEspejos;

/* @var $post EntPosts*/

$postEspejos = new EntEspejos();
$espejo = $postEspejos->find()->where(['id_post'=>$post->id_post])->one();
?>

<div class="pin pin-espejo"
	onclick="showPostFull('<?=$post->txt_token?>')">

	<div class="pin-header pin-header-espejo"></div>

	<div class=image>
		<img src="<?=Url::base()?>/webAssets/images/espejo.png">
	</div>


	<div class="pin-content-wrapper" lang="en">
		<div class="pin-descripcion" style="
    max-height: 500px;
    overflow: hidden;
"><?=$post->txt_descripcion?></div>
	</div>

	<div class="pin-social">

		<div class="pin-social-usr">
		<?php
		if($espejo->b_anonimo == 0){
			$usuario = $post->idUsuario;

			if (! empty ( $usuario )) {
				echo Html::img ( $usuario->getImageProfile());
				echo '<span>' . $usuario->txt_username . '</span>';
			}
		}else{
			echo '<span>Netanauta</span>';
		}
		?>

	</div>
		<div class="pin-social-interactions">
			<span><?=$post->entEspejos->num_subscriptores?></span> <i
				class="icon icon-fire"></i>
		</div>

	</div>

</div>
