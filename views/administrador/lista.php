<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Administrador */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Administrador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrador-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum administrador ainda foi cadastrado.',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'Nome',
			'email',
			'strNivelGerencial',
			'Telefone',
		]
	]);

	echo $grid;
?>

</div>