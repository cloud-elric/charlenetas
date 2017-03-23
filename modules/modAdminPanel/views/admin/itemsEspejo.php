<?php
	use app\models\EntPosts;

	foreach ( $postsEspejo as $postEspejo ) {
// 		$espejo = $postEspejo->entEspejos;
// 		$espejoContestado = false;
// 		if (! empty ( $espejo->entRespuestasEspejo )) {
// 			$espejoContestado = true;
// 		}
		$post = EntPosts::find()->where(['id_post'=>$postEspejo->id_post])->one();
		?>
		<div class="col s12 m6 l4" id="card_<?=$post->txt_token?>">
			<div class="card card-espejo" data-token="<?=$post->txt_token?>">
				
				<div class="card-contexto-cont">
					<p class="card-desc"><?=$post->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($post->entEspejos)?0:$post->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span><?php //echo $espejoContestado?'Espejo respondido':'Espejo no respondido' ?> </span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$post->txt_token?>"
							value="<?=$post->txt_token?>" /> <label
							class="espejo-delete-check"
							for="delete-<?=$post->txt_token?>"></label>
					</div>
					<a id="button_<?=$post->txt_token?>"
						class="waves-effect waves-light modal-trigger"
						onclick="abrirModalResponderEspejo('<?=$post->txt_token?>')"
						href="#js-modal-post-editar"> <i
						class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>

		<?php } ?>