<?php use app\modules\ModUsuarios\models\Utils;

 foreach ($postsMedia as $postMedia){?>
	
	<div class="col s12 m6 l4" id="card_<?=$postMedia->txt_token?>">
			<div class="card card-media" data-token="<?=$postMedia->txt_token?>" style="background-image: url(http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($postMedia->txt_url)?>/mqdefault.jpg)">
				<!-- <h3> -->
					<!-- <img src="http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($postMedia->txt_url)?>/mqdefault.jpg"> -->
				<!-- </h3> -->

				<div class="card-contexto-options">
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarMedia('<?=$postMedia->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
	</div>
		<?php }?>