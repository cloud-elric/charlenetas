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
			//'css/component.css',
			//'plugins/pins-grid/pins.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css',
			'https://fonts.googleapis.com/icon?family=Material+Icons',
			'webAssets/css/web-styles.css',
			'plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
			'//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
			'css/temporal.css',
			'css/animate.css',
			'css/login.css',
	];
	public $js = [
			// 'js/codrops-js/modernizr.custom.js',
			// 'js/codrops-js/masonry.pkgd.min.js',
			// 'js/codrops-js/imagesloaded.js',
			// 'js/codrops-js/classie.js',
			// 'js/codrops-js/AnimOnScroll.js',
			'js/charlenetas.js',
			//'plugins/pins-grid/pins.min.js',
			//'plugins/pins-grid/pins.js',
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js',
			'http://masonry.desandro.com/masonry.pkgd.js',
			'plugins/ladda-bootstrap/dist/spin.min.js',
			'plugins/ladda-bootstrap/dist/ladda.min.js',
			'js/login.js',
			'//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'

	]
	;
	public $depends = [
			'yii\web\YiiAsset'
	]
	// 'yii\bootstrap\BootstrapAsset',
	;

}
