<?php 
namespace app\modules\modAdminPanel\assets;

use yii\web\AssetBundle;
class ModuleAsset extends AssetBundle
{
    
    public $sourcePath = '@app/modules/modAdminPanel/web/';
    public $css = [
        
    ];
    public $js = [
    		//'js/charlenetas--alquimia.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        
    ];
}