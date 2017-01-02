<?php use app\models\EntComentariosPosts;

	foreach ($postsHoyPense as $postHoyPense){ ?>
		
		<div class="col s12 m6 l4" id="card_<?=$postHoyPense->txt_token?>">
			<div class="card card-hoy-pense" data-token="<?=$postHoyPense->txt_token?>">
				
				<div class="card-contexto-cont">
					<h3 class="card-title"><?= $postHoyPense->txt_titulo ?></h3>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find()->where(['id_post'=>$postHoyPense->id_post])->andWhere(['is', 'id_comentario_padre',null])->count("id_post") ?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
      					<input type="checkbox" id="delete-<?=$postHoyPense->txt_token?>" value="<?=$postHoyPense->txt_token?>"/>
      					<label for="delete-<?=$postHoyPense->txt_token?>"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarHoyPense('<?=$postHoyPense->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>

		<?php } ?>