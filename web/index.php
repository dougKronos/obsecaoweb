<?php
// Define nossa variável APPLICATION_ENV conforme fornecida por nginx/apache/console
if (!defined('APPLICATION_ENV')){
	if (getenv('APPLICATION_ENV') != false){
		define('APPLICATION_ENV', getenv('APPLICATION_ENV'));
	} else{
		// define('APPLICATION_ENV', 'prod');
		define('APPLICATION_ENV', 'dev');
	}
}

$env = require(__DIR__ . '/../config/env.php');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', $env['debug']);
defined('YII_ENV') or define('YII_ENV', APPLICATION_ENV);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
