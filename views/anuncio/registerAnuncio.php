<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */
/* @var $form ActiveForm */

$this->title = 'Registrar Anuncio';
?>
<style type="text/css">
	#anuncioform-csexo > label:last-child{
		margin-left:10px;
	}
</style>
<div class="register-anuncioForm">
	<h1><?= Html::encode($this->title) ?></h1>
	
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'strTitulo')->textInput(['style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strDescricao')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strNome')->textInput(['style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strRaca')->textInput(['style'=>'width:400px;']) ?>
		
		<?php 
			$cSexoList = array('M' => 'Masculino', 'F' => 'Feminino');
			$model->cSexo = 'M';
		?>
		<?= $form->field($model, 'cSexo')->radioList($cSexoList) ?>
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
				1 => 'Janeiro',
				2 => 'Fevereiro',
				3 => 'Março',
				4 => 'Abril',
				5 => 'Maio',
				6 => 'Junho',
				7 => 'Julho',
				8 => 'Agosto',
				9 => 'Setembro',
				10 => 'Outubro',
				11 => 'Novembro',
				12 => 'Dezembro'
			], ['style'=>'width:150px;'])
		?>
		<?= $form->field($model, 'strCaracteristicas')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		<?= $form->field($model, 'strComportamentais')->textarea(['rows' => '3', 'style'=>'width:400px;']) ?>
		
		<?php
		// 'cSexo'
		// 'strRaca'
		// 'nIdadeAno'
		// 'nIdadeMes'
		// 'strCaracteristicas'
		// 'strComportamentais'
		// 'strNomeFoto'
		?>



		<?= Html::submitButton(Yii::t('app', 'Registrar'), ['class' => 'btn btn-primary']) ?>
	<?php ActiveForm::end(); ?>

</div>