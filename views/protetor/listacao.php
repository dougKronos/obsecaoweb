<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Protetor */

// use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\models\Cao;
use yii\helpers\Url;

$this->title = 'Lista de caes para adotar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-lista">
     <h1><?= Html::encode($this->title) ?></h1>


<?php 
	$grid = GridView::widget([
		'dataProvider' => $provider,
		'emptyText' => 'Nenhum cão ainda foi registrado.',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'Nome',
			'Sexo',
			'Raca',
			[
				'label' => 'Idade',
				// 'format' => 'raw',
				'value' => function($model){
					$strAnos = '';
					$strMeses = '';
					if($model['nIdadeAno'] != 0 && $model['nIdadeMes'] != 0){
						$strAnos = "{$model['nIdadeAno']} " . ($model['nIdadeAno'] > 1 ? ' anos e ' : ' ano e ');
						$strMeses = $model['nIdadeMes']. (($model['nIdadeMes'] > 1) ? ' meses de idade.' : ' mes de idade.');
					} elseif($model['nIdadeAno'] != 0 && $model['nIdadeMes'] == 0) {
						$strAnos = "{$model['nIdadeAno']} " . ($model['nIdadeAno'] > 1 ? ' anos de idade.' : ' ano de idade.');
					} else {
						$strMeses = $model['nIdadeMes']. (($model['nIdadeMes'] > 1) ? ' meses de idade.' : ' mes de idade.');
					}
					return $strAnos.$strMeses;
				}
			],
			// 'nIdadeAno',
			// 'nIdadeMes',
			'Status Fisico',
			'Comportamental',
			'Nome Protetor',
			'Adotante',
			[
				'label' => 'Foto',
				'format' => 'raw',
				'value' => function($model){
					return Html::img('@web/images/fotosAnuncios/'.$model['Foto'], ['alt' => 'fotoCao', 'style'=>'width:100px;']);
				}
			],
			'Adotado',
			[
				'header' => 'Adotar',
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',
				'buttons' => [
					'view' => function($url, $model, $key){
						// exit(var_dump($model['id']));
						return 
							Html::a(
								'<span class="glyphicon glyphicon-ok"></span>', 
								Url::to(['protetor/adotar', 'nCaoID' => $model['nCaoID']]),
								['title' => Yii::t('yii', 'Adotar')]
							);
					}
				]
			]
		]
	]);

	echo $grid;
?>

</div>