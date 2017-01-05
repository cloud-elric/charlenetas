<?php
	foreach ( $postsEspejo as $postEspejo ) {
		$espejo = $postEspejo->entEspejos;
		$espejoContestado = false;
		if (! empty ( $espejo->entRespuestasEspejo )) {
			$espejoContestado = true;
		}
		?>
		<div class="col s12 m6 l4" id="card_<?=$postEspejo->txt_token?>">
			<div class="card card-espejo" data-token="<?=$postEspejo->txt_token?>">
				
				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postEspejo->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($postEspejo->entEspejos)?0:$postEspejo->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span><?=$espejoContestado?'Espejo respondido':'Espejo no respondido'?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div class="card-contexto-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>

					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalResponderEspejo('<?=$postEspejo->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>

		<?php } ?>