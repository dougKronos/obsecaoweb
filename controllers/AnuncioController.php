<?php

namespace app\controllers;

use app\models\Anuncio;

class AnuncioController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Anuncio();

		return $this->render('lista', [
            'provider' => $model->getGridAnuncios(5),
        ]);
	}

	public function actionPermissoes(){
		$model = new Anuncio();

		return $this->render('permissoes', [
			'provider' => $model->getGridPermissoes(5),
		]);
	}
}
