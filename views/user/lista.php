<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\User */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
	.table-striped > tbody > tr:nth-of-type(2n){
		color:black !important;
		font-weight:bold;
	}
	.table > thead:nth-child(1) > tr{
		background-color: #e37f7f;
	}
</style>
<div class="user-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum usuário ainda foi cadastrado.',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'Nome',
			'email',
			'Administrador',
			'Protetor',
			'Adotante',
			'Telefone',
			// 'emailAlternativo',
			// 'strTelefoneAlternativo',
			// 'nEnderecoID',
			// 'dtCriacao',
			// 'dtAtualizacao',
		]
	]);

	echo $grid;
?>

</div>