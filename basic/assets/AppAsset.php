<?php
namespace app\assets;

use yii\web\AssetBundle;


class AppAsset extends AssetBundle
{

    //public $sourcePath = '@app/../build/';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['defer'=>true];
    public $css = [
        "build/css/main-min.css",
    ];

    public $js = [
        "build/js/index-min.js" 
    ];

    public $depends = [
        
    ];

    /*
    public $publishOptions = [    
           'forceCopy' => YII_ENV_DEV,    
    ];
    */
}
