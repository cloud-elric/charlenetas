<?php
use app\models\EntComentariosPosts;
?>

<!-- .page-header -->
<div class="page-header">
	<h2 class="page-title"><i class="ion ion-android-people"></i> Usuarios</h2>
</div>
<!-- end /.page-header -->

<!-- .page-cont -->
<div class="page-cont">

	<div class="row">

		<div class="col s12 m6 l4">
			<div class="card card-user">
				<div class="card-user-cont">
					<div class="row">
						<div class="col s3">
							<div class="card-user-avatar">
								<img src="assets/imgs/avatar.png" alt="Avatar">
									<div class="card-user-status card-user-status-deshabilitado"></div>
							</div>
  									<!-- <p class="card-user-status">Habilitado</p>
									<p class="card-user-status">Deshabilitado</p> -->
						</div>
						<div class="col s9">
							<p class="card-user-nombre">Juan Perez</p>
							<p class="card-user-email">juan-perez@2gom.com.mx</p>
							<p class="card-user-tipo-user">Avanzado</p>
						</div>
					</div>
				</div>
				<div class="card-user-statistics">
					<p class="card-user-statistics-comentarios">
						<i class="ion ion-android-textsms"></i> 12
					</p>
					<p class="card-user-statistics-feeds">
						<i class="ion ion-ios-list-outline"></i> 12
					</p>
					<p class="card-user-statistics-creditos">
						<i class="ion ion-cash"></i> 12
					</p>
					<p class="card-user-statistics-contracion">
						<i class="ion ion-android-playstore"></i> 12
					</p>
				</div>
			</div>
		</div>
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
		echo EntComentariosPosts::find()->where(['id_usuario'=>$usuario->id_usuario])->sum("num_trolls");
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