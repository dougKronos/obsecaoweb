<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrar um Anúncio';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .messageWarning{ text-shadow:2px 2px yellow;width:400px;}
    .control-label{ width:140px; }
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, preencha os seguintes campos para registrar um anúncio:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'saveCao-form',
        'method' => 'post',
        'action' => ['cao/save'],
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n
            <div class=\"col-lg-8 messageWarning\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'strNome')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'cSexo')->radioList([
                'M' => 'Macho', 'F' => 'Fêmea'
            ]
        ) ?>
        <?php //echo $form->field($model, 'nIdadeAnos')->textInput(); ?>

        <?php 
            $listData = array();
            for ($i=0; $i <= 40; $i++) { $listData[] = $i;}
            echo $form->field($model, 'nIdadeAnos')->dropDownList($listData, ['prompt'=>'Selecione...']);
        ?>
        
        <?php 
            $listData = [0, 1,2,3,4,5,6,7,8,9,10,11,12];
            echo $form->field($model, 'nIdadeMeses')->dropDownList($listData, ['prompt'=>'Selecione...']);
        ?>

        <?php echo $form->field($model, 'strRaca')->textInput(); ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <?php //echo $form->field($model, 'rememberMe')->checkbox([
            //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        //]); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('SaveDog', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
