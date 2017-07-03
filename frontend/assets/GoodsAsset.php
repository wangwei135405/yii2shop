<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class GoodsAsset extends  AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/goods.css',
        'style/common.css',
        'style/bottomnav.css',
        'style/footer.css',

    ];
    public $js = [
        'js/header.js',
        'js/goods.js',
        'js/jqzoom-core.js',

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}