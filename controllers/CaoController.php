<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Cao;
use yii\web\UploadedFile;

class CaoController extends Controller{

    /**
    * Displays homepage.
    *
    * @return string
    */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAnuncios(){
    	$caoModel = new Cao();
    	$listCao = $caoModel->listAll();
    	return $this->render('anuncios',[
    		'listCao' => $listCao
    	]);
    }

    public function actionRegister(){
    	$model = new Cao();
    	return $this->render('saveCao', [
    		'model' => $model
    	]);
    }

    public function actionSave(){
    	$model = new Cao();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // Falta registrar no banco os dados do cao

                // file is uploaded successfully
                return $this.actionAnuncios();
            }
        }

        exit('Foi');
    }

}

?>