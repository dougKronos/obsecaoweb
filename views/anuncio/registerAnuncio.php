<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */
/* @var $form ActiveForm */

$this->title = 'Registrar Anuncio';
?>
<style type="text/css">
	#anuncioform-csexo > label:last-child{
		margin-left:10px;
	}
	.register-anuncioForm{
		position:relative;
	}
	.register-anuncioForm::after{
		width:625px;
		position:absolute;
		left:-10px;
		height:calc(100% - 35px);
		content:'';
		background-color:#73e168;
		top:45px;
		z-index:-1;
		border-radius:4px;
	}
	.col-lg-1{
		width:17%;
	}
	#register-cao-form{
		padding-top:20px;
	}
	.help-block.help-block-error {
		width:605px;
		text-align:right;
	}
</style>
<div class="register-anuncioForm">
	<h1><?= Html::encode($this->title) ?></h1>
	
	<?php $form = ActiveForm::begin([
		'id' => 'register-cao-form',
		'method' => 'post',
		'action' => ['anuncio/register'],
		'layout' => 'horizontal',
		'options' => ['enctype' => 'multipart/form-data'],
		'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n
            <div class=\"col-lg-8 messageWarning\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
	]); ?>
		<?= $form->field($model, 'strTitulo')->textInput(['style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strDescricao')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strNome')->textInput(['style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strRaca')->textInput(['style'=>'width:400px;']) ?>
		
		<?php 
			$cSexoList = array('M' => 'Masculino', 'F' => 'Feminino');
			$cSexo = 'M';
		?>
		
		<?= $form->field($model, 'cSexo')->dropdownList([
			'M' => 'Masculino',
			'F' => 'Feminino'
			], ['style'=>'width:150px;'])
		?>

		<?php //echo $form->field($model, 'cSexo')->textInput(); ?>
		
		<?php //echo $form->field($model, 'cSexo')->radioList($cSexoList); ?>
		<?= $form->field($model, 'nIdadeAno')->dropdownList([
				'' => 'Selecione...',
				0 => 'Nenhum Ano',
				1 => '1 Ano',
				2 => '2 Anos',
				3 => '3 Anos',
				4 => '4 Anos',
				5 => '5 Anos',
				6 => '6 Anos',
				7 => '7 Anos',
				8 => '8 Anos',
				9 => '9 Anos',
				10 => '10 Anos',
				11 => '11 Anos',
				12 => '12 Anos'
			], ['style'=>'width:150px;'])
		?>
		<?= $form->field($model, 'nIdadeMes')->dropdownList([
				'' => 'Selecione...',
				0 => 'Nenhum mês',
				1 => '1 mês',
				2 => '2 meses',
				3 => '3 meses',
				4 => '4 meses',
				5 => '5 meses',
				6 => '6 meses',
				7 => '7 meses',
				8 => '8 meses',
				9 => '9 meses',
				10 => '10 meses',
				11 => '11 meses'
			], ['style'=>'width:150px;'])
		?>
		<?= $form->field($model, 'strCaracteristicas')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strComportamentais')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		
		<?= $form->field($model, 'imageFile')->fileInput() ?>

		<?php
		// 'cSexo'
		// 'strRaca'
		// 'nIdadeAno'
		// 'nIdadeMes'
		// 'strCaracteristicas'
		// 'strComportamentais'
		// 'strNomeFoto'
		?>



		<?= Html::submitButton(Yii::t('app', 'Registrar'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
	<?php ActiveForm::end(); ?>

</div>