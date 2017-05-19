<?php
use app\models\EntComentariosPosts;
?>

<?php foreach ( $postsVerdadazos as $postVerdadazos ) {?>
		<div class="col s12 m6 l4" id="card_<?=$postVerdadazos->txt_token?>">

			<div class="card card-verdadazos" data-token="<?=$postVerdadazos->txt_token?>" onclick="showPostFull('<?=$postVerdadazos->txt_token?>')">
				
				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postVerdadazos->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postVerdadazos->id_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$postVerdadazos->txt_token?>" value="<?=$postVerdadazos->txt_token?>" />
						<label for="delete-<?=$postVerdadazos->txt_token?>"></label>
					</div>
					<a id="button_<?=$postVerdadazos->txt_token?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarVerdadazos('<?=$postVerdadazos->txt_token?>')" href="#js-modal-post-editar"> 
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>
<script>
var elementNuevo = document.getElementById("button_<?=$postVerdadazos->txt_token?>");
elementNuevo.addEventListener("click", stopEvent, false);
$('#button_<?=$postVerdadazos->txt_token?>').leanModal();
</script>
<?php }?>