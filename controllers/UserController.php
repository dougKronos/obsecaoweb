<?php

namespace app\controllers;

use app\models\User;

class UserController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new User();

		return $this->render('lista', [
            'provider' => $model->getGridUsers(5),
        ]);
	}

}
