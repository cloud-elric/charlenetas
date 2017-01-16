<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

class AppAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
			'css/charlenetas.css',
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css',
			'https://fonts.googleapis.com/icon?family=Material+Icons',
			'webAssets/css/web-styles.css',
			'plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
			'//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
			'css/temporal.css',
			'css/animate.css',
			'css/login.css',
			'plugins/animsition/css/animsition.min.css',
			'plugins/owl/css/owl.carousel.css',
			'plugins/ionicons/css/ionicons.min.css',
			'css/fullcalendar.css',
			'css/sweetalert.css'

	];
	public $js = [
			
			'js/charlenetas.js',
			
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js',
			'http://masonry.desandro.com/masonry.pkgd.js',
			'plugins/ladda-bootstrap/dist/spin.min.js',
			'plugins/ladda-bootstrap/dist/ladda.min.js',
			'js/login.js',
			'//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
			'plugins/animsition/js/animsition.min.js',
			'plugins/owl/js/owl.carousel.min.js',
			'js/moment.min.js',
			'js/fullcalendar.js',
			'js/calendario.js',
			'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.13/clipboard.min.js',
			'js/sweetalert.min.js'

	]
	;
	public $depends = [
			'yii\web\YiiAsset'
	]
	// 'yii\bootstrap\BootstrapAsset',
	;

}
