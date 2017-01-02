<?php
use app\models\EntComentariosPosts;
?>

<?php foreach ($postsSoloPorHoy as $postSoloPorHoy){?>
		<div class="col s12 m6 l4" id="card_<?=$postSoloPorHoy->txt_token?>">
			<div class="card card-solo-por-hoy" data-token="<?=$postSoloPorHoy->txt_token?>">
				

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSoloPorHoy->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postSoloPorHoy->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
      					<input type="checkbox" id="delete-<?=$postSoloPorHoy->txt_token?>" value="<?=$postSoloPorHoy->txt_token?>"/>
      					<label for="delete-<?=$postSoloPorHoy->txt_token?>"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSoloPorHoy('<?=$postSoloPorHoy->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>
		<?php }?>