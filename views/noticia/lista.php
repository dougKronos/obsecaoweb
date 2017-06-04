<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Noticia */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Notícias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhuma notícia ainda foi cadastrada.' 
	]);

	echo $grid;
?>

</div>