<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/charlenetas.css',
    	'plugins/pins-grid/pins.min.css',
      'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css',
      'https://fonts.googleapis.com/icon?family=Material+Icons',
      'assets/css/web-styles.css'
    ];
    public $js = [
    	'js/charlenetas.js',	
      'plugins/pins-grid/pins.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
