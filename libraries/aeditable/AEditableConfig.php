<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\libraries\aeditable;

/**
 * Description of AEditableConfig
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class AEditableConfig extends \mcms\xeditable\XEditableConfig{
    //put your code here
    public function registerDefaultAssets()
	{
		parent::init();

		if(empty($this->defaults))
			$this->defaults = array();
		if(empty($this->defaults['mode']))
			$this->defaults['mode'] = $this->mode;

		$defaults = \yii\helpers\Json::encode($this->defaults);
		AEditableAsset::register($this->view);

		$this->view->registerJs("
		if($.fn.editable)
		$.extend(
			$.fn.editable.defaults , $defaults);
			/*$.fn.editable.defaults.ajaxOptions = {
				type: 'post',
				success:function(data){
					alert(data);
				}
			}*/
		");
	}
}
