<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Cao */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Cães';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cao-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum cão ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>