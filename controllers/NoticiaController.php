<?php

namespace app\controllers;

use app\models\Noticia;


class NoticiaController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionLista(){
		$model = new Noticia();

		return $this->render('lista', [
            'provider' => $model->getGridNoticias(5),
        ]);
	}

}
