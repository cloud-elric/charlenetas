<?php
// Si esta en DEBUG
if (YII_ENV_DEV) {
	$dataBase = ['class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=mysql3000.mochahost.com;dbname=beto2gom_charlenetas',
			'username' => 'beto2gom_c-netas',
			'password' => 'b4n4n4M0nk3y!',
			'charset' => 'utf8'
	];

// 	$dataBase = [
// 			'class' => 'yii\db\Connection',
// 			'dsn' => 'mysql:host=localhost;dbname=charlenetas_geekdb',
// 			'username' => 'root',
// 			'password' => 'root',
// 			'charset' => 'utf8'
// 	];
} else {
	$dataBase = [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=mysql1003.mochahost.com;dbname=beto2gom_charlenetas',
			'username' => 'beto2gom_c-netas',
			'password' => 'b4n4n4M0nk3y!',
			'charset' => 'utf8'
	];
}

return $dataBase;
