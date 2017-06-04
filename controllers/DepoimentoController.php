<?php

namespace app\controllers;

use app\models\Depoimento;

class DepoimentoController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Depoimento();

		return $this->render('lista', [
            'provider' => $model->getGridDepoimentos(5),
        ]);
	}

	public function actionPermissoes(){
		$model = new Depoimento();

		return $this->render('permissoes', [
			'provider' => $model->getGridPermissoes(5),
		]);
	}

}
