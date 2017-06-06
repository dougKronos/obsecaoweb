<?php

namespace app\controllers;

use app\models\Recusa;

class RecusaController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Recusa();

		return $this->render('lista', [
            'provider' => $model->getGridRecusas(5),
        ]);
	}

}
