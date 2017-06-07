<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use app\models\LoginForm;
use app\models\User;
use app\models\Endereco;
use app\models\Protetor;
use app\models\Adotante;
use app\models\UserForm;
use app\models\ContactForm;
use yii\db\Expression;

class SiteController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		// exit(var_dump(Yii::$app->request->post()));
		$model = new UserForm(['scenario' => 'login']);
		if ($model->load(Yii::$app->request->post())) {
			if ($model->login())            
				return $this->goHome();
		}
		return $this->render('forms/LoginForm', [
			'model' => $model,
		]);
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionRegister(){
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		// exit(var_dump(Yii::$app->request->post()['UserForm']));
		$model = new UserForm(['scenario' => 'register']);
		if ($model->load(Yii::$app->request->post())) {
			if($model->validate()){
				$fkModel = NULL;

				$postArgs = Yii::$app->request->post()['UserForm'];
				$strTypeRole = $postArgs['strTypeRole'];
				if($strTypeRole == 'Adotante'){
					$adotanteModel = new Adotante(['scenario' => 'register']);

					// exit(var_dump($postArgs));
					$arrBooleans = $postArgs['listAdotanteData'];
					$postData = [
						'Adotante' => [
							'bPossuiCriancas' => 0,
							'bPossuiPets' => 0,
							'bAdotouAntes' => 0,
						]
					];
					if(!is_string($arrBooleans)){
						foreach ($arrBooleans as $value) {
							if($value == 0){
								$postData['Adotante']['bPossuiCriancas'] = 1;
							} elseif ($value == 1) {
								$postData['Adotante']['bPossuiPets'] = 1;
							} elseif ($value == 2) {
								$postData['Adotante']['bAdotouAntes'] = 1;
							}
						}
					}
					$postData['Adotante']['strDetalhesLocal'] = $postArgs['strDetalhesLocal'];

					if($adotanteModel->load($postData)){
						if($adotanteModel->validate()){
							$adotanteModel->dtCriacao = new Expression('NOW()');
							$adotanteModel->dtAtualizacao = new Expression('NOW()');
							// $adotanteModel->save();
							$fkModel = $adotanteModel;
						} else {
							$arrErrors = $adotanteModel->getErrors();
							foreach ($arrErrors as $key => $value) {
								$model->addError($key, array_shift($value));
							}
							return $this->render('forms/RegisterForm', [
								'model' => $model,
							]);
						}
					}
				} else if($strTypeRole == 'Protetor'){
					$protetorModel = new Protetor(['scenario' => 'register']);

					$arrBooleans = $postArgs['listProtetorData'];
					$postData = [
						'Protetor' => [
							'bRealizaEntrega' => 0
						]
					];
					if(!is_string($arrBooleans)){
						foreach ($arrBooleans as $value) {
							if($value == 0){
								$postData['Protetor']['bRealizaEntrega'] = 1;
							}
						}
					}
					if($protetorModel->load($postData)){
						if($protetorModel->validate()){
							$protetorModel->dtCriacao = new Expression('NOW()');
							$protetorModel->dtAtualizacao = new Expression('NOW()');
							// $protetorModel->save();
							$fkModel = $protetorModel;
						} else {
							$arrErrors = $protetorModel->getErrors();
							foreach ($arrErrors as $key => $value) {
								$model->addError($key, array_shift($value));
							}
							return $this->render('forms/RegisterForm', [
								'model' => $model,
							]);
						}
					}
				}
				$enderecoModel = new Endereco(['scenario' => 'register']);
				$arrEnderecoData = [
					'Endereco' =>[
						'strLogradouro' => $postArgs['strLogradouro'],
						'nNumero' => $postArgs['nNumero'],
						'strBairro' => $postArgs['strBairro'],
						'strComplemento' => $postArgs['strComplemento'],
						'nCidadeID' => (int)$postArgs['strIdCidade']
					]
				];
				if($enderecoModel->load($arrEnderecoData)){
					if($enderecoModel->validate()){
						// Aqui está tudo certo!!!
						$enderecoModel->dtCriacao = new Expression('NOW()');
						$enderecoModel->dtAtualizacao = new Expression('NOW()');
						$enderecoModel->save();
						$fkModel->save();
						if($strTypeRole == 'Protetor'){
							$nProtetorAdotanteID = $fkModel->nProtetorID;
						} else {
							$nProtetorAdotanteID = $fkModel->nAdotanteID;
						}
						$allUserDataFinal = [
							'User' => $postArgs
						];
						if($model->saveNewUser($allUserDataFinal, $nProtetorAdotanteID, $enderecoModel->nEnderecoID, $strTypeRole)){
							$model = new UserForm(['scenario' => 'login']);
							if($model->load([
								'UserForm' => $postArgs
							])){
								if($model->login()){
									return $this->goHome();
								}
							}
						}
						

						// $adotanteModel->save();
						// $fkModel = $adotanteModel;
					} else {
						$arrErrors = $enderecoModel->getErrors();
						foreach ($arrErrors as $key => $value) {
							$model->addError($key, array_shift($value));
						}
					}
					return $this->render('forms/RegisterForm', [
						'model' => $model,
					]);
				}


				// exit('Não Passou!!');


				// exit(var_dump($postArgs));
				// $fkModel->dtCriacao = new Expression('NOW()');
				// $fkModel->dtAtualizacao = new Expression('NOW()');


				// if($model->saveNewUser(Yii::$app->request->post(), $fkModel, $xxx, $strTypeRole){
				// 	return $this->goHome();
				// }
			}
		}
		return $this->render('forms/RegisterForm', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return string
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout(){
		return $this->render('about');
	}

}
