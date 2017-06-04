<?php

namespace app\controllers;

use app\models\Adotante;

class AdotanteController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Adotante();

		return $this->render('lista', [
            'provider' => $model->getGridAdotantes(5),
        ]);
	}

}
