<?php
namespace app\assets;

class CareerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/media/template';
    public $css = [
        //'css/bootstrap.min.css',
'css/select2.min.css',
'css/mega_menu.min.css',
'css/animate.min.css',
'css/owl.carousel.css',
'css/owl.style.css',
'css/style.css',
'css/font-awesome.min.css',
'css/et-line-fonts.css',
'css/toastr.min.css',        
    ];
    public $js = [
        //'js/jquery-3.1.1.min.js',
//'js/jquery-migrate-1.2.1.min.js',
'js/bootstrap.min.js',
'js/select2.min.js',
'js/mega_menu.min.js',
'js/counterup.js',
'js/waypoints.min.js',
'js/footer-reveal.min.js',
'js/owl-carousel.js',
'js/custom.js',
'js/toastr.min.js',        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
       'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
}
