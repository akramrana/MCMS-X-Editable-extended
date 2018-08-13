<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\libraries\aeditable;

/**
 * Description of AEditableAsset
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class AEditableAsset extends \mcms\xeditable\XEditableAsset {

    public $sourcePath = 'plugins/';
    public $js = [
        "xeditable/bootstrap3-editable/js/bootstrap-editable.js"
    ];
    public $css = [
        "xeditable/bootstrap3-editable/css/bootstrap-editable.css"
    ];
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
