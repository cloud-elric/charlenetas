<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

$this->title = 'Espejos';
?>
<!-- .page-cont -->
<div class="page-cont">
	<div class="row">
	<?php
	foreach ( $postsEspejo as $postEspejo ) {
		$espejo = $postEspejo->entEspejos;
		$espejoContestado = false;
		if (! empty ( $espejo->entRespuestasEspejo )) {
			$espejoContestado = true;
		}
		?>
		<div class="col s12 m6 l4">
			<div class="card card-espejo">
				<h3><?=$postEspejo->txt_descripcion?></h3>
				<p><?=$postEspejo->entEspejos->num_subscriptores?> susbcritores</p>
				<?=$espejoContestado?'Espejo respondido':'Espejo no respondido'?>
				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>

					</div>
					<i class="ion ion-android-more-vertical card-edit"></i>
				</div>
			</div>
		</div>


		<?php } ?>
		
	</div>
	<!-- end /.row -->

	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<!-- <i class="ion ion-wand"></i> --> <i
			class="ion ion-ios-trash-outline"></i>
		</a>
		<?php # include 'templates/modalPost.php'; ?>
	</div>
	<!-- end /.fixed-action-btn -->


</div>
<!-- end /.page-cont -->

<?php

// foreach ( $postsEspejo as $postEspejo ) {
// 	echo $postEspejo->entEspejos->num_subscriptores . "   ";
// 	echo $postEspejo->txt_descripcion . "   ";
// 	echo $postEspejo->txt_imagen . "   ";
// 	echo $postEspejo->txt_url . "   ";
// 	echo $postEspejo->fch_creacion . "   ";
// 	echo $postEspejo->fch_publicacion . "   ";
	
// 	echo "</br>";
// 	echo "</br>";
// }
// echo "total posts= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postEspejo->id_tipo_post 
// ] )->count ( "id_tipo_post" . "   " );
// echo "total likes= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postEspejo->id_tipo_post 
// ] )->sum ( "num_likes" );
// echo "total comentarios= " . EntComentariosPosts::find ()->where ( [ 
// 		'id_post' => $postEspejo->id_tipo_post 
// ] )->count ( "id_post" );

	