<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Adotante */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Adotantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adotante-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum adotante ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>