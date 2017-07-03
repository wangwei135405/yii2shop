<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class Flow2Asset extends  AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/success.css',
        'style/footer.css',

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
