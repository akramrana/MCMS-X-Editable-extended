<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\libraries\aeditable;

use yii\helpers\Json;
/**
 * Description of AEditableColumn
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class AEditableColumn extends \mcms\xeditable\XEditableColumn {

    private $view = null;
    //put your code here
    public function init() {
        parent::init();
        $this->registerAssets();
    }

    /**
     * @inheritdoc
     */
    protected function getDataCellContent($model, $key, $index) {
        $primaryKey = $model->primaryKey();
        $this->pk = $primaryKey[0];
        if (empty($this->url)) {
            $this->url = \Yii::$app->urlManager->createUrl($_SERVER['REQUEST_URI']);
        }

        if (empty($this->value)) {
            $value = ArrayHelper::getValue($model, $this->attribute);
        } else {
            $value = call_user_func($this->value, $model, $index, $this);
        }

        $value = '<a href="#" data-name="' . $this->attribute . '" data-value="' . $model->{$this->attribute} . '"  class="editable" data-type="' . $this->dataType . '" data-pk="' . $model->{$this->pk} . '" data-url="' . $this->url . '" data-title="' . $this->dataTitle . '">' . $value . '</a>';

        return $value;
    }
    
    /**
     * @inheritdoc
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

        $this->view = \Yii::$app->getView();
        AEditableAsset::register($this->view);
        $this->editable = Json::encode($this->editable);
        $this->view->registerJs('$(".editable[data-name=' . $this->attribute . ']").editable(' . $this->editable . ');');
    }

}
