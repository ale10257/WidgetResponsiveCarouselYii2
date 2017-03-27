<?php

namespace app\components\widgets\responsive_carousel;


class AssetResponsiveCarousel extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/components/widgets/responsive_carousel/media';
    public $css = [
        'responsive_carousel.css',
    ];
    public $js = [
        'responsiveCarousel.js',
        'custom_responsive_carousel.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}