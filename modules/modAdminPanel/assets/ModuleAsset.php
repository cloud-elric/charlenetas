<?php

namespace app\modules\modAdminPanel\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle {
	public $sourcePath = '@app/modules/modAdminPanel/web/';
	public $css = [ 
			//'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css',
			'https://fonts.googleapis.com/icon?family=Material+Icons',
			'materialize/css/materialize.min.css',
			'css/ionicons.min.css',
			'css/asScrollable.min.css',
			'css/charlenetas.css',
			'css/temporal.css',
			'fullcalendar-3.0.1/fullcalendar.css',
			'//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'
	];
	public $js = [ 
			//'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js',
			'materialize/js/materialize.min.js',
			'js/jquery.mousewheel.min.js',
			'js/jquery-asScrollable.min.js',
			'js/charlenetas.js',
			'fullcalendar-3.0.1/lib/moment.min.js',
			'fullcalendar-3.0.1/fullcalendar.js',
			'//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'
	];
	
	public $depends = [ 
			'yii\web\YiiAsset' 
	];
}