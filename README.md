# MCMS-X-Editable-extended
Extended version of  marciocamello/yii2-x-editable.

# First install MCMS X-Editable

X-editable extensions for Yii 2, based in X-editable 1.5.1 with Bootstrap 3 Link from project - http://vitalets.github.io/x-editable/
Installation

The preferred way to install this extension is through composer.

Either run

php composer.phar require marciocamello/yii2-x-editable "dev-master"

or add

"marciocamello/yii2-x-editable": "*"

to the require section of your composer.json file.

# clone or download repository
 https://github.com/akramrana/MCMS-X-Editable-extended.git
 and do following....

1.Put the libraries folder on your project root directory  

2.Put Plugins folder into the web folder

# Usage
Once the libraries is installed, simply use it in your code by :

# Actions

```
public function actions() {
	return [
		'editable' => [
			'class' => 'app\libraries\aeditable\AEditableAction',
			'modelclass' => Brands::className(),
		],
	];
}
```

# Text

```
[
	'value' => function($model) {
		return $model->carriage_id;
	},
	'class' => app\libraries\aeditable\AEditableColumn::className(),
	'url' => 'editable',
	'dataType' => 'text',
	'attribute' => 'carriage_id',
	'format' => 'raw',
	'editable' => [
		'validate' => new \yii\web\JsExpression('
					function(value) {
							if($.trim(value) == "") {
									return "This field is required";
							}
					}
		'),
	],
],
```

## For more info follow this https://github.com/marciocamello/yii2-x-editable