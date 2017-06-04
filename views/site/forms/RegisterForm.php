<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */
/* @var $form ActiveForm */

$this->title = 'Registrar Conta';
?>
<div class="site-form-RegisterForm">
    <style type="text/css">
        .form-group > input[type="email"],
        .form-group > input[type="password"],
        .form-group > input[type="text"]{
            width:400px;
        }
        div.form-group.has-error{
            position:relative;
            height:80px;
        }
        div.form-group.has-error > .help-block::after,
        div.form-group.has-error > .control-label::after{
            position:absolute;
            width:130%;
            height:18px;
            content:'';
            left:-6px;
            z-index:-1;
            border-radius:7px;
        }
        div.form-group.has-error > .control-label{
            background-color:red;
            color:white;
        }
        div.form-group.has-error > .help-block::after{
            background-color: #ff6c00;
        }
        div.form-group.has-error > .help-block{
            position:absolute;
            color:white;
            left:0;
            right:auto;
        }

    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'strNome') ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'strSenha')->passwordInput() ?>
        <?= $form->field($model, 'strTelefone') ?>
        <?= $form->field($model, 'strTypeRole') ?>
        <?= $form->field($model, 'emailAlternativo') ?>
        <?= $form->field($model, 'strTelefoneAlternativo') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-form-RegisterForm -->
