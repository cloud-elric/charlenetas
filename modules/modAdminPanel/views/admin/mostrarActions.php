<?php 
use sspl\meta\MetaData;
use app\models\EntActions;
use app\models\RelUsuarios;
use app\models\ModUsuariosEntUsuarios;

function from_camel_case($input) {
	preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
	$ret = $matches[0];
	foreach ($ret as &$match) {
		$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
	}
	return implode('-', $ret);
}
?>

<?php 
	$admin_actions = Yii::$app->metadata->getActions('AdminController');
    $actions = $admin_actions;
    $i = 1;
   	foreach($admin_actions as $admin){  		
   		$admin = from_camel_case($admin);
   		$actions = new EntActions();
   		$action = $actions->find()->where(['id_action'=>$i])->one();
   		
   		$tiposUsuarios = new ModUsuariosEntUsuarios();
   		$usuario = $tiposUsuarios->find()->where(['id_usuario'=>Yii::$app->user->identity->id_usuario])->one();
   		
   		$relaciones = new RelUsuarios();
   		
   		if(!$action){
   			$actions->id_action = $i;
   			$actions->txt_action = $admin;
		    $actions->save();
		    $i++;
		    $relaciones->id_tipo_usuario = $usuario->id_tipo_usuario;
		    $relaciones->id_action = $i;
		    $relaciones->save();
   		}
   		
   		echo $admin;
	    echo "<br>";
   }
?> 