<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\libraries\aeditable;

/**
 * Description of AEditableAction
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class AEditableAction extends \mcms\xeditable\XEditableAction {

    //put your code here
    /**
     * @inheritdoc
     */
    public function run() {
        if (\Yii::$app->request->isAjax) {
            $pk = $_POST['pk'];
            $name = $_POST['name'];
            $value = $_POST['value'];

            $modelclass = $this->modelclass;
            $model = $modelclass::findOne($pk);
            if ($this->scenario) {
                $model->setScenario($this->scenario);
            }

            AEditable::saveAction([
                'name' => $name,
                'value' => $value,
                'model' => $model,
            ]);
        }
    }

}
