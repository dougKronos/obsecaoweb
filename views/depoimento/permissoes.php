<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Anuncio */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Permissões de Depoimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depoimento-permissao-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhuma permissão de depoimento ainda solicitada.' 
	]);

	echo $grid;
?>

</div>