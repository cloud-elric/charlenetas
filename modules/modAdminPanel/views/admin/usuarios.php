<?php
use app\models\EntComentariosPosts;
use app\models\EntUsuariosFeedbacks;
use yii\helpers\Html;
?>

<!-- .page-header -->
<div class="page-header">
	<h2 class="page-title"><i class="ion ion-android-people"></i> Usuarios</h2>
</div>
<!-- end /.page-header -->

<!-- .page-cont -->
<div class="page-cont">

	<div class="row">

	<?php foreach($usuarios as $usuario){ ?>

		<div class="col s12 m6 l4">
			<div class="card card-user">
				<div class="card-user-cont">
					<div class="row">
						<div class="col s3">
							<div class="card-user-avatar">
								<?= Html::img ( $usuario->getImageProfile())?>
								<div class="card-user-status card-user-status-deshabilitado"></div>
							</div>
  									<!-- <p class="card-user-status">Habilitado</p>
									<p class="card-user-status">Deshabilitado</p> -->
						</div>
						<div class="col s9">
							<p class="card-user-nombre"><?= $usuario->txt_username?></p>
							<p class="card-user-email"><?= $usuario->txt_email?></p>
							<p class="card-user-tipo-user"><?= $usuario->idTipoUsuario->txt_nombre?></p>
						</div>
					</div>
				</div>
				<div class="card-user-statistics">
					<p class="card-user-statistics-comentarios">
						<i class="ion ion-android-textsms"></i> <?= count($usuario->entComentariosPosts)?>
					</p>
					<p class="card-user-statistics-feeds">
						<i class="ion ion-ios-list-outline"></i> <?= EntUsuariosFeedbacks::find()->where(['id_usuario'=>$usuario->id_usuario])->count("id_tipo_feedback");?>
					</p>
					<p class="card-user-statistics-creditos">
						<i class="ion ion-cash"></i> 0
					</p>
<!-- 					<p class="card-user-statistics-contracion"> -->
<!-- 						<i class="ion ion-android-playstore"></i> 12 -->
<!-- 					</p> -->
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>


<div class="js-contenedor-ususarios" >
<?php
	
	foreach($usuarios as $usuario)
	{
		echo $usuario->txt_username. "  ";
		echo $usuario->txt_email . "  "; 
		echo $usuario->txt_imagen . "  ";
		echo $usuario->idStatus->txt_nombre . "  ";
		echo $usuario->idTipoUsuario->txt_nombre . "  ";
		echo count($usuario->entComentariosPosts) . "  ";
		echo "trolls" . EntComentariosPosts::find()->where(['id_usuario'=>$usuario->id_usuario])->sum("num_trolls") . "    //";
		
		echo EntUsuariosFeedbacks::find()->where(['id_usuario'=>$usuario->id_usuario])->count("id_tipo_feedback");
	
		echo "</br>";
	}
?>
</div>

<!-- <script>
	function cargarUsuarios(){
		$.ajax({
			url:'usuarios?page=1&q=h',
			success:function(rest){
					$(".js-contenedor-ususarios").append(rest);
				}
			})
	}
</script> -->