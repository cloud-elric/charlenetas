<?php
use yii\helpers\Html;
?>
<span>Calificación Charlenetas</span>
<?php
$alquimia = $post->entAlquimias;
?>
<?=$alquimia->contenedorEstrellas(Html::encode($alquimia->num_calificacion_admin))?>

<span>Calificación netanautas</span>
<?=$alquimia->contenedorEstrellas(Html::encode($alquimia->num_calificacion_usuario))?>


<span>Tu calificación</span>
<?php
if (Yii::$app->user->isGuest) {
	$calificacionUsuario = false;
} else {
	$calificacionUsuario = Yii::$app->user->identity->getEntUsuariosCalificacionAlquimias ()->where ( [ 
			'id_post' => $post->id_post 
	] )->one ();
}

if ($calificacionUsuario) {
	$numCalificacion = $calificacionUsuario->num_calificacion;
} else {
	$numCalificacion = 0;
}
echo $alquimia->contenedorEstrellas ( Html::encode ( $numCalificacion ), $post->txt_token, true, true );

?>