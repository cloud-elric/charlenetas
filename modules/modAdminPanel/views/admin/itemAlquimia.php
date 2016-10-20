<?php
use app\models\EntComentariosPosts;

foreach ($postsAlquimia as $postAlquimia){
?>	

		<div class="col s12 m6 l4" id="card_<?=$postAlquimia->txt_token?>">
			<div class="card card-alquimia" data-token="<?=$postAlquimia->txt_token?>">
				
				<div class="card-contexto-cont">
					<h3 class="card-title"><?= $postAlquimia->txt_titulo ?></h3>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_post])->andWhere(['is', 'id_comentario_padre',null])->count("id_post") ?></span>
					</p>

				</div>

				<div class="card-contexto-options">
					<a id="button_<?=$postAlquimia->txt_token?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarAlquimia('<?=$postAlquimia->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
					
				</div>
			</div>
		</div>

		<?php } ?>