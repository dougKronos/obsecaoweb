<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\User */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
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