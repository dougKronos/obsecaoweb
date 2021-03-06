<?php

namespace app\controllers;

use app\models\Cao;

class CaoController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Cao();

		return $this->render('lista', [
            'provider' => $model->getGridCaes(5),
        ]);
	}

}
