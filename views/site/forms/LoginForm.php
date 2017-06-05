<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */
/* @var $form ActiveForm */

$this->title = 'Login';
?>
<div class="site-form-LoginForm">
	<style type="text/css">
		.field-userform-email,
		.field-userform-strsenha{
			height:80px;
		}
		.field-userform-strsenha > .help-block,
		.field-userform-email > .help-block{
			position: absolute;
			left:0px;
			right:auto;
			color:white;
		}
		.field-userform-email,
		.field-userform-strsenha,
		.has-error .control-label{
			position:relative;
			color:white;
		}
		.field-userform-email > .help-block::after,
		.field-userform-strsenha > .help-block::after{
			background-color: #ff6c00;
		}
		.has-error .control-label::after{
			background-color:red;
		}
		.field-userform-email > .help-block::after,
		.field-userform-strsenha > .help-block::after,
		.has-error .control-label::after{
			position:absolute;
			width:130%;
			height:18px;
			content:'';
			left:-6px;
			z-index:-1;
			border-radius:7px;
		}
		.profile-link{
			border:1px solid black;
			border-radius:3px;
			padding:4px;
			background-color:#5C6199;
		}
		.has-success .control-label{
			background-color:#a7da71;
			padding-left:5px;
			padding-right:5px;
			border-radius:5px;
		}
	</style>
	<?=	Html::style('#userform-email{width:400px;}#userform-strsenha{width:400px;}.registerLink{display:inline-block;margin-left:15px;}.registerLink > a{color:#FFF; text-decoration:none;}') ?>
	<h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'strSenha')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary']) ?>
	    	<?=	Html::tag(
	    		'div', 
	    		Html::a('Nova Conta', ['site/register'], ['class' =>	'profile-link']),
	    		['class' =>	'registerLink']
	    	) ?>
        </div>
    <?php ActiveForm::end(); ?>


</div>
