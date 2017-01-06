<?php foreach ($postsSabiasQue as $postSabiasQue){ ?>
	
		<div class="col s12 m6 l4" id="card_<?=$postSabiasQue->txt_token?>">
			<div class="card card-sabias-que" data-token="<?=$postSabiasQue->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSabiasQue->txt_descripcion?></p>
				</div>

				<div class="card-contexto-options">

				<div>
				<input type="checkbox" id="delete-<?=$postSabiasQue->txt_token?>" value="<?=$postSabiasQue->txt_token?>" />
				<label for="delete-<?=$postSabiasQue->txt_token?>"></label>
			</div>

					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSabiasQue('<?=$postSabiasQue->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>
		
		<script>
var elementNuevo = document.getElementById("button_<?=$postSabiasQue->txt_token?>");
elementNuevo.addEventListener("click", stopEvent, false);
$('#button_<?=$postSabiasQue->txt_token?>').leanModal();
</script>
	<?php }?>