<?php foreach ($postsSabiasQue as $postSabiasQue){ ?>
	
		<div class="col s12 m6 l4" id="card_<?=$postSabiasQue->txt_token?>">
			<div class="card card-sabias-que" data-token="<?=$postSabiasQue->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSabiasQue->txt_descripcion?></p>
				</div>

				<div class="card-contexto-options">
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSabiasQue('<?=$postSabiasQue->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>
	<?php }?>