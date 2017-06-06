<?php

namespace app\controllers;

use app\models\Anuncio;
use yii\web\UploadedFile;
use app\models\AnuncioForm;

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

	public function actionRegister(){
		$model = new AnuncioForm();

		return $this->render('registerAnuncio', [
			'model' => $model,
		]);


		$model = new AnuncioForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // Falta registrar no banco os dados do cao

                // file is uploaded successfully
                // return $this.actionAnuncios();
                return true;
            }
        }
	}

}
