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
		if(\Yii::$app->user->isGuest)
			return $this->goHome();
		if(!\Yii::$app->user->identity)
			return $this->goHome();
		if(isset(\Yii::$app->user->identity->nProtetorID))
			return $this->goHome();

		$anuncioModel = new AnuncioForm(['scenario' => 'register']);
		if($anuncioModel->load(\Yii::$app->request->post())){
			if($anuncioModel->validate()){

			}
		}
		return $this->render('registerAnuncio', [
			'model' => $anuncioModel,
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
