<?php

namespace app\controllers;

use app\models\Protetor;

class ProtetorController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Protetor();

		return $this->render('lista', [
            'provider' => $model->getGridProtetores(5),
        ]);
	}

}
