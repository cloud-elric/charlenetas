<?php

namespace app\modules\modAdminPanel\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle {
	public $sourcePath = '@app/modules/modAdminPanel/web/';
	public $css = [ 
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css',
			'https://fonts.googleapis.com/icon?family=Material+Icons',
			'css/charlenetas.css' 
	];
	public $js = [ 
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js' 
	];
	
	public $depends = [ 
			'yii\web\YiiAsset' 
	];
}