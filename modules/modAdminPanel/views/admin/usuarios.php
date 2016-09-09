<?php
use app\models\EntComentariosPosts;
?>
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