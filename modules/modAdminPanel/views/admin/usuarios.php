<div class="js-contenedor-ususarios" >
<?php
	foreach($usuarios as $usuario)
	{
		echo $usuario->txt_username. "  ";
		echo $usuario->txt_email . "  "; 
		echo $usuario->txt_imagen . "  ";
		echo $usuario->idStatus->txt_nombre . "  ";
		echo $usuario->idTipoUsuario->txt_nombre . "  ";
		echo "</br>";
	}
?>
</div>

<script>
	function cargarUsuarios(){
		$.ajax({
			url:'usuarios?page=1&q=h',
			success:function(rest){
					$(".js-contenedor-ususarios").append(rest);
				}
			})
	}
</script>