<?php
	foreach($notificaciones as $notificacion){
		echo $notificacion->id_notificacion;
		$notificacion->b_leido = 1;
		if($notificacion->save())
			echo "success";
		else
			echo "error";
	}
	