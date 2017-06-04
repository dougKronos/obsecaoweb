<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Anuncio */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Anúncios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum anúncio ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>