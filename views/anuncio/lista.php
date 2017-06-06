<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Anuncio */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Anúncios';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
	.grid-view{
		margin-top:20px;
	}
</style>
<div class="anuncio-lista">
    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(['action' => ['/anuncio/register']], ['class'=>'formRegister', 'visible' => true]); ?>
		<?= Html::submitButton(Yii::t('app', 'Registrar novo anuncio'), ['class' => 'btn btn-primary']) ?>
	<?php ActiveForm::end(); ?>
<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum anúncio ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>