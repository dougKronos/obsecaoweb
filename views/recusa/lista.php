<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Protetor */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Recusas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recusa-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhuma recusa ainda foi cadastrada.' 
	]);

	echo $grid;
?>

</div>