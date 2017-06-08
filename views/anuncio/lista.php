<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Anuncio */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

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

	<?php 
		$form = ActiveForm::begin(['action' => ['/anuncio/register']], ['class'=>'formRegister']); ?>
	<?php if((!\Yii::$app->user->isGuest) && (isset(\Yii::$app->user->identity->nProtetorID) || Yii::$app->user->identity->isAdministrador())):
	?>
		<?= Html::submitButton(Yii::t('app', 'Registrar novo anuncio'), [
			'class' => 'btn btn-primary', 'visible' => false])
		?>
	<?php endif; ?>
	<?php ActiveForm::end(); ?>
<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum anúncio ainda foi cadastrado ou liberado.',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'Título',
			'Descrição',
			// 'nCaoID'
			'Data Registro',
			[
				'header' => 'Visualizar',
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',
				'buttons' => [
					'view' => function($url, $model, $key){
						// exit(var_dump($model['id']));
						return 
							Html::a(
								'<span class="glyphicon glyphicon-search"></span>', 
								Url::to(['anuncio/detalhe',
									'nAnuncioID' => $model['nAnuncioID']
								]),
								['title' => Yii::t('yii', 'Visualizar')]
							);
					}
				]
			]
		]
	]);

	echo $grid;
?>

</div>