<?php 
use sspl\meta\MetaData;

?>

<?php 
	$admin_actions = Yii::$app->metadata->getActions('AdminController');
    $actions = $admin_actions; 
   	foreach($admin_actions as $admin){  		
   		$actions = $admin;
	    $tam = strlen($admin)-1;
	    
	    for($i=0;$i<$tam;$i++){
	   	 	if($admin[$i] == strtoupper($admin[$i]) && $i>0){
	   			$admin[$i] = "-";
	   		}else if($admin[$i] == strtoupper($admin[$i])){
	   			$admin[$i] = strtolower($admin[$i]);
	   		}
	   }
	   for($i=0;$i<$tam;$i++){
	   	if($actions[$i] == strtoupper($actions[$i])){
	   		$actions[$i] = strtolower($actions[$i]);
	   	}
	   }
	   for($i=0;$i<$tam;$i++){
	   	if($admin[$i] != $actions[$i]){
	   		$admin[$i+1] = $actions[$i];
	   	}
	   }
	   
	   echo $admin;
	   echo "<br>";
   }
?> 