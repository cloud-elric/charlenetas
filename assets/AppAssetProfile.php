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
class AppAssetProfile extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [ 
			'plugins/profile-remark/css/bootstrap.min.css',
			'plugins/profile-remark/css/bootstrap-extend.min.css',
			'plugins/animsition/css/animsition.min.css',
			'plugins/profile-remark/css/profile.min.css',
			'plugins/profile-remark/material-design/material-design.min.css',
			'plugins/profile-remark/site.min.css',
			'plugins/slidepanel/jquery-slidePanel.min.css',
			'css/profile-usuario.css'
	];
	public $js = [ 
			'plugins/animsition/js/animsition.min.js',
			'plugins/profile-remark/js/bootstrap.min.js',
			'js/profile.js',
	]
	;
	public $depends = [ 
			'yii\web\YiiAsset' 
	];
	// 'yii\bootstrap\BootstrapAsset',
	
}
