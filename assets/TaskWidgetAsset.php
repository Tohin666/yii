<?php

namespace app\assets;

use yii\web\AssetBundle;

class TaskWidgetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/taskWidget.css'
    ];
    public $js = [
    ];
    public $depends = [
    ];

}