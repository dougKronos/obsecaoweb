<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Protetor */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Protetores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum protetor ainda foi cadastrado.' 
	]);

	echo $grid;
?>

</div>