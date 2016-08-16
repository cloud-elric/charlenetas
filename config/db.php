<?php
// Si esta en DEBUG
if (YII_ENV_DEV) {
	$dataBase = [ 
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=charlenetas',
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8' 
	];
} else {
	$dataBase = [ 
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=yii2basic',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8' 
	];
}

return $dataBase;
