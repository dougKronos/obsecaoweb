<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?= Html::jsFile('@web/assets/56c733b2/jquery.min.js'); ?>

    <?= Html::jsFile('@web/js/index.js'); ?>
    <?= Html::cssFile('@web/css/origin.css'); ?>
    <?php 
        echo $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']);
    ?>
    <?php $this->head() ?>
</head>
<body style="background: url(/images/bg.jpg) no-repeat center center fixed;">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Obsecao',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'Anúncios', 'url' => '/index.php?r=site/anuncios'],
            ['label' => 'Anúncios', 'url' => ['/cao/anuncios']],
            ['label' => 'Sobre', 'url' => ['/site/about']],
            // [
            //     'label' => 'Gerenciar',
            //     'items' => [
            //         ['label' => 'Minha Conta', 'url' => '#', 'visible' => (!Yii::$app->user->isGuest)],
            //         ['label' => 'Administrativo', 'url' => '#', 'visible' => (!Yii::$app->user->isGuest)]
            //     ]
            // ],
            ['label' => 'Contatos', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                Html::tag('li',
                    Html::beginForm(['/site/logout'], 'post').
                    Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    ).
                    Html::endForm()   
                )
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Obsecao <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
