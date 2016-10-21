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
			'css/fullcalendar.css',
			'plugins/ladda-bootstrap/ladda-themeless.min.css',
			'plugins/tags-input/jquery.tagsinput.min.css'
	];
	public $js = [ 
			//'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js',
			'materialize/js/materialize.min.js',
			'js/jquery.mousewheel.min.js',
			'js/jquery-asScrollable.min.js',
			'js/charlenetas.js',
			'js/moment.min.js',
			'js/fullcalendar.js',
			'js/charlenetas-calendario.js',
			
			'plugins/ladda-bootstrap/spin.min.js',
			'plugins/ladda-bootstrap/ladda.min.js',
			'plugins/tags-input/jquery.tagsinput.min.js'
	];
	
	public $depends = [ 
			'yii\web\YiiAsset' 
	];
}