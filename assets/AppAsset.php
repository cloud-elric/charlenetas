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
<<<<<<< HEAD
      'plugins/pins-grid/pins.min.css',
      'assets/css/web-styles.css',
      'plugins/pins-grid/pins-grid.css',
      'css/tarjetas.css'
=======
    	'plugins/pins-grid/pins.min.css',
      'assets/css/web-styles.css'
>>>>>>> diseño-de-Pins-grid
    ];
    public $js = [
    	'plugins/pins-grid/vendor.js',
    	'plugins/pins-grid/pins-grid.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
