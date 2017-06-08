<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = 'Detalhes do Cão para Adoção';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'strTitulo',
        'strDescricao',               // title attribute (in plain text)
        // 'description:html',    // description attribute in HTML
        [                      // the owner name of the model
            'label' => 'Nome do Cão',
            'value' => $model->getNCao()->one()->strNome,
        ],
        [
        	'label' => 'Data Registro',
        	'format' => 'datetime',
        	'value' => $model->dtCriacao,
        ],
        // 'dtCriacao:datetime', // creation date formatted as datetime
        [
        	'label' => 'Foto',
        	'format' => 'raw',
        	'value' => Html::img('@web/images/fotosAnuncios/'.$model->getNCao()->one()->strNomeFoto, ['alt' => 'fotoCao', 'style'=>'width:200px;'])
        ],
    ],
]);


?>