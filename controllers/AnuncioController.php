<?php

namespace app\controllers;

use app\models\Anuncio;
use yii\web\UploadedFile;
use app\models\AnuncioForm;
use app\models\Cao;
use yii\db\Expression;

class AnuncioController extends \yii\web\Controller{

	public function actionPermitir($id){
		$model = Anuncio::find($id)->one();
		$model->bAprovado = 1;
		$model->save();
		return \Yii::$app->runAction('anuncio/lista');
	}

	public function actionDetalhe($nAnuncioID){
		$model = Anuncio::find($nAnuncioID)->one();
		return $this->render('detalhe', [
            'model' => $model,
        ]);
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
		if(isset(\Yii::$app->user->identity->nAdotanteID))
			return $this->goHome();

		$anuncioModel = new AnuncioForm(['scenario' => 'register']);
		if(\Yii::$app->request->isPost){
			if($anuncioModel->load(\Yii::$app->request->post())){
				$cSexo = \Yii::$app->request->post()['AnuncioForm']['cSexo'];
				if($anuncioModel->validate()){
					$strPhotoName = $anuncioModel->uploadPhoto();
					
					if($strPhotoName){
						$caoModel = new Cao();
						$caoModel->strNome            = $anuncioModel->strNome;
						$caoModel->cSexo              = $cSexo;
						$caoModel->strRaca            = $anuncioModel->strRaca;
						$caoModel->nIdadeAno          = $anuncioModel->nIdadeAno;
						$caoModel->nIdadeMes          = $anuncioModel->nIdadeMes;
						$caoModel->strCaracteristicas = $anuncioModel->strCaracteristicas;
						$caoModel->strComportamentais = $anuncioModel->strComportamentais;
						$caoModel->strNomeFoto        = $strPhotoName;
						$caoModel->nProtetorID        = \Yii::$app->user->identity->nProtetorID;
						$caoModel->dtCriacao          = new Expression('NOW()');
						$caoModel->dtAtualizacao      = new Expression('NOW()');

						$caoModel->save();

						$anuncioAR = new Anuncio();
						$anuncioAR->bAprovado     = 0;
						$anuncioAR->strTitulo     = $anuncioModel->strTitulo;
						$anuncioAR->strDescricao  = $anuncioModel->strDescricao;
						$anuncioAR->nCaoID        = $caoModel->nCaoID;
						$anuncioAR->dtCriacao     = new Expression('NOW()');
						$anuncioAR->dtAtualizacao = new Expression('NOW()');

						$anuncioAR->save();

						return $this->actionLista();
					}
				}
			}
		}

		return $this->render('registerAnuncio', [
			'model' => $anuncioModel,
		]);
	}

}
