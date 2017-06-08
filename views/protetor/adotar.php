<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Protetor */

// use yii\helpers\Html;
use yii\bootstrap\Html;
// use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Adotar';
$this->params['breadcrumbs'][] = $this->title;

	$arrAdotsTemp = [];
	$arrAdots = [];

	foreach ($modelAdotantes as $adot) {
		$arrAdotsTemp[$adot['nAdotanteID']] = $adot;
	}

	foreach ($arrAdotsTemp as $key => $adot) {
		$user = $adot->getUsers()->one();
		$arrAdots[$key] = $user->strNome;
	}
	
?>
<div class="protetor-lista">
     <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
	'id' => 'register-cao-form',
	'method' => 'post',
	'action' => ['protetor/fim_adocao'],
	'layout' => 'horizontal',
	'options' => ['enctype' => 'multipart/form-data'],
	'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n
        <div class=\"col-lg-8 messageWarning\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

	<?php 
		// Aqui teria que ter um Form para validar os dados e enviar para salvar em uma action do Controller final		

		echo $form->field($model, 'attribute')
	        ->dropDownList(
	            $arrAdots,           // Flat array ('id'=>'label')
	            ['prompt'=>'Selecione...']    // options
	        );
	?>


	<?= Html::submitButton(Yii::t('app', 'Realizar Adoção'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
<?php ActiveForm::end(); ?>

</div>