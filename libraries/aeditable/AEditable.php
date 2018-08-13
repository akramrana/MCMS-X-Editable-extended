<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\libraries\aeditable;

use yii\helpers\ArrayHelper;

/**
 * Description of AEditableAction
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class AEditable extends \mcms\xeditable\XEditable {

    /**
     * @see Xeditable
     * @see Init extension default
     */
    public function init() {
        parent::init();
        $this->registerAssets();
    }

    /**
     * @see Xeditable
     * @see Load extension with all settings
     */
    public function run() {
        $this->jsOptions();
        $this->registerScript();
        return $this->htmlOptions();
    }

    public static function saveAction($data) {
        $model = ArrayHelper::getValue($data, 'model');
        $name = ArrayHelper::getValue($data, 'name');
        $value = ArrayHelper::getValue($data, 'value');

        if ($model === null)
            throw new NotFoundHttpException();
        if (!is_array($value)) {
            $isValidDate = self::validateDateTime($value);
            if (strtotime($value) && $isValidDate) {
                $model->$name = strtotime($value);
            } else {
                $model->$name = $value;
            }
        } else {
            $model->$name = implode(',', $value);
        }

        if ($model->validate()) {
            $model->update();
        } else {
            VarDumper::dump($model->getErrors(), 10);
        }
    }

    /**
     * @see Xeditable
     * @see Register assets from this extension and yours types
     */
    public function registerAssets() {

        $config = new AEditableConfig();

        if (isset($this->pluginOptions['mode']) && is_array($this->pluginOptions)) {
            $config->mode = $this->pluginOptions['mode'];
        }

        if (isset($this->pluginOptions['form']) && is_array($this->pluginOptions)) {
            $config->form = $this->pluginOptions['form'];
        }

        $config->registerDefaultAssets();

        if ($this->type == 'select2') {
            \mcms\xeditable\Select2Asset::register($this->view);
        }

        if ($this->type == 'datetime') {
            //DateTimePickerAsset::register($this->view);
        }

        if ($this->type == 'date') {
            //DatePickerAsset::register($this->view);
        }

        if ($this->type == 'typeaheadjs') {
            \mcms\xeditable\TypeaheadAsset::register($this->view);
        }

        if ($this->type == 'combodate') {
            //ComboDateAsset::register($this->view);
        }

        if ($this->type == 'wysihtml5') {
            //WysiHtml5Asset::register($this->view);
        }

        $this->view = \Yii::$app->getView();
        AEditableAsset::register($this->view);
    }

    private static function validateDateTime($dateStr, $format = 'Y-m-d') {
        date_default_timezone_set('UTC');
        $date = \DateTime::createFromFormat($format, $dateStr);
        return $date && ($date->format($format) === $dateStr);
    }

}
