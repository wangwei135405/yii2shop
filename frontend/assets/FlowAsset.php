<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FlowAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/cart.css',
        'style/footer.css',
    ];
    public $js = [
        'js/cart1.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}