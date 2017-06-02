1<?php

/* @var $this yii\web\View */
/* @var $listCao app\models\Cao */

use yii\helpers\Html;
use yii\bootstrap\Carousel;

$VERSION = '1495948134';

$this->title = 'Anúncios';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::style('
    .carousel-caption{left:12%; text-align:left; right:40%; top:-25px; } .carousel-control.left{line-height:300px; text-indent:-65px; } .carousel-control.right{line-height:300px; text-indent:35px; } .carousel-indicators{visibility:hidden; } .site-anuncio{color:white; } .label-dog{color:#00ffe4; }
') ?>
<div class="site-anuncio">
     <h1><?= Html::encode($this->title) ?></h1>
     <?= 
        Html::beginForm(['/cao/register'], 'post').
        Html::submitButton(
            'Registrar Anúncio',
            ['class' => 'btn btn-primary', 'style' => 'margin-bottom:5px;']
        ).
        Html::endForm();
     ?>
<?php 

    foreach ($listCao as $cao) {
        $sex = "<span class='label-dog'>Sexo: </span> {$cao['cSexo']}";
        $strIdade = $cao['nIdadeAnos'] != '0' ? "{$cao['nIdadeAnos']} anos" : '';
        if(!empty($strIdade))
            $strIdade .= $cao['nIdadeMeses'] != '0' ? " e {$cao['nIdadeMeses']} meses." : ".";
        else
            $strIdade .= $cao['nIdadeMeses'] != '0' ? " {$cao['nIdadeMeses']} meses." : ".";

        $items[] = [
            'content' => Html::img("@web/images/fotosAnuncios/{$cao['strNomeFoto']}?v=$VERSION", [
                'alt' => "anuncio{$cao['nCaoID']}",
                'style' => '
                    width:300px;
                    height:300px;
                    margin-left:auto;
                    margin-right:155px;
                '
            ]),
            'caption' => "
                <h3 style='color:#f9ff00;'>{$cao['strNome']}</h3>
                <h4>{$sex}</h4>
                <h4><span class='label-dog'>Raça: </span>{$cao['strRaca']}</h4>
                
                
                <h4><span class='label-dog'>Idade: </span>$strIdade</h4>
                
                <h4><span class='label-dog'>Características Físicas: </span>{$cao['strCaracteristicas']}</h4>
                <h4><span class='label-dog'>Características Comportamentais: </span>{$cao['strCaracteristicasComport']}</h4>
            "
        ];
    }

    echo Carousel::widget([
        'items' => $items
    ]);
?>
<script type="text/javascript">
    // Remove caracter estranho (???)
    var breadcrumb = $('.breadcrumb');
    if(!!breadcrumb){
        breadcrumb = breadcrumb[0];
        if(breadcrumb.nextSibling.textContent.trim() === '1')
            $(breadcrumb.nextSibling).remove();
    }
</script>
</div>