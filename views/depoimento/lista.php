<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Depoimento */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Depoimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depoimento-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum depoimentos ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>