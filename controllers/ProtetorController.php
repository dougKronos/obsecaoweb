<?php

namespace app\controllers;

use app\models\Protetor;
use app\models\Adotante;
use app\models\Cao;

class ProtetorController extends \yii\web\Controller{

	public function actionDetalhe(){
		return $this->render('detalhe');
	}

	public function actionListacao($nProtetorID){
		$model = new Protetor();

		return $this->render('listaCao', [
			'provider' => $model->getGridCaos(5, $nProtetorID)
		]);
	}

	public function actionLista(){
		$model = new Protetor();

		return $this->render('lista', [
            'provider' => $model->getGridProtetores(5),
        ]);
	}

	public function actionAdotar($nCaoID){
		$modelCao = Cao::find($nCaoID)->one();
		$modelAdotantes = Adotante::find()->all();
		$modelForm = new ProtetorForm(['scenario' => 'register']);

		return $this->render('adotar', [
			'modelCao' => $modelCao,
			'modelAdotantes' => $modelAdotantes,
			'modelForm' => $modelForm
		]);
	}

	public function actionFim_adocao(){
		return \Yii::$app->runAction('site/index');
	}

}
