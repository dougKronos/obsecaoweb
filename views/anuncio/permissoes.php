<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Anuncio */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Permissões de Anúncios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-permissao-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhuma permissão de anúncio ainda solicitada.',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'Título',
			'Descrição',
			'Data Registro',
			// 'template' => '{update} {view}',
			[
				'header' => 'Permitir',
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'buttons' => [
					'update' => function($url, $model, $key){
						// exit(var_dump($model['id']));
						return 
							Html::a(
								'<span class="glyphicon glyphicon-ok"></span>', 
								Url::to(['anuncio/permitir', 'id' => $model['nAnuncioID']]),
								['title' => Yii::t('yii', 'Permitir')]
							);
					}
				]
			]
		]
		
	]);

	echo $grid;
?>

</div>