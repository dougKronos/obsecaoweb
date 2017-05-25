<?php
namespace app\modules\mymodule;

class Module extends \yii\base\Module {

	// public $defaultRoute = 'user'; // user maps to UserController

	public function init(){
		parent::init();

		// Set custom parameters
		\Yii::configure($this, require __DIR__ . '/config/config.php');
	}
}

?>