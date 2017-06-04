<?php

namespace app\controllers;

use app\models\Administrador;

class AdministradorController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Administrador();

		return $this->render('lista', [
            'provider' => $model->getGridAdministradores(5),
        ]);
	}

}
