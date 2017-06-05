<?php 

namespace app\models;

use yii\db\Query;
use yii\db\Expression;

/**
* UserForm
*/
class UserForm extends \yii\base\Model{

	private $_user = false;

	public $strNome;
	public $email;
	public $emailAlternativo;
	public $strSenha;
	public $strTelefone;
	public $strTelefoneAlternativo;
	public $strTypeRole; // Não pertence a table 'user'

	// Adotante
	public $listAdotanteData;
	public $strDetalhesLocal;

	// Protetor
	public $listProtetorData;

	// Endereço
	public $nEstadoID;
	public $nCidadeID;

	public $strIdCidade;
	public $strIdEstado;

	public $strLogradouro;
	public $nNumero;
	public $strBairro;
	public $strComplemento;


	/**
	 * @inheritdoc
	 */
	public function init(){
		parent::init();

		// custom initialization code goes here
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['email'], 'required', 'on' => 'login', 'message' => 'Q email é obrigatório!'],
			[['strSenha'], 'required', 'on' => 'login', 'message' => 'A senha é obrigatória!'],
			[['email'], 'string', 'max' => 100, 'on' => 'login', 'message' => 'O email pode ter no máximo 100 caracteres!'],
			[['strSenha'], 'string', 'max' => 255, 'on' => 'login', 'message' => 'A senha pode ter no máximo 255 caracteres!'],

			[['strTelefone'], 'required', 'on' => 'register', 'message' => 'O telefone é obrigatório!'],
			[['strNome'], 'required', 'on' => 'register', 'message' => 'O nome é obrigatório!'],
			[['email'], 'required', 'on' => 'register', 'message' => 'Q email é obrigatório!'],

			[['strSenha'], 'validatePassword', 'on' => 'login'],
			[['strSenha'], 'required', 'on' => 'register', 'message' => 'A senha é obrigatória!'],
			
			[['strNome', 'email', 'emailAlternativo'], 'string', 'max' => 100, 'on' => 'register', 'message' => 'Este campo pode ter no máximo 100 caracteres!'],
			[['strSenha'], 'string', 'max' => 255, 'on' => 'register', 'message' => 'A senha pode ter no máximo 255 caracteres!'],
			[['strTelefone', 'strTelefoneAlternativo'], 'string', 'max' => 30, 'on' => 'register', 'message' => 'Este campo pode ter no máximo 30 caracteres!'],
			[['email'], 'validateEmail','on' => 'register'],

			[['strIdEstado'], 'required', 'on' => 'register', 'message' => 'O estado é obrigatório!'],
			[['strIdCidade'], 'required', 'on' => 'register', 'message' => 'A cidade é obrigatória!']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'strNome' => 'Nome',
			'email' => 'Email',
			'strSenha' => 'Senha',
			'strTelefone' => 'Telefone',
			'strTelefoneAlternativo' => 'Telefone Alternativo',
			'strTypeRole' => 'Tipo de Cadastro',

			// Adotante
			'strDetalhesLocal' => 'Detalhes da moradia do adotante',
			'bPossuiCriancas' => 'Possui Criancas?',
			'bPossuiPets' => 'Já Possui Pets?',
			'bAdotouAntes' => 'Já adotou antes?',

			// Protetor
			'bRealizaEntrega' => 'Já realizou entrega?',
			'nEstadoID' => 'Estado',
			'strIdCidade' => 'Cidade',
			'strIdEstado' => 'Estado',
		];
	}

	public function validateEmail($attributes, $params){
		$user = User::findOne(['email' => $this->email]);
		if(!isset($user)){
			return true;
		} else {
			$this->addError('email', 'Email já utilizado!');
		}
	}

	/**
	* Finds user by [[email]]
	* @return User|null
	*/
	public function getUser(){
		if ($this->_user === false)
			$this->_user = User::findOne(['email' => $this->email]);

		return $this->_user;
	}

	/**
	* Validates the password.
	* This method serves as the inline validation for password.
	*
	* @param string $attribute the attribute currently being validated
	* @param array $params the additional name-value pairs given in the rule
	*/
	public function validatePassword($attribute, $params) {
		if (!$this->hasErrors()){
			if (!$this->getUser() || !$this->getUser()->validatePassword($this->strSenha)) {
				$this->addError($attribute, 'O email ou a senha está incorreto!');
			}
		}
	}

	/**
	* Logs in a user using the provided email and password.
	* @return boolean whether the user is logged
	in successfully
	*/
	public function login()	{
		if ($this->validate()){
			if (\Yii::$app->user->login($this->getUser()))
				return true;
		}
		return false;
	}

	public function saveNewUser($postParams, $fkModel, $addressModel, $strTypeRole){
		$this->_user = new User;
		$this->_user->load($postParams);
		$this->_user->dtCriacao = new Expression('NOW()');
		$this->_user->dtAtualizacao = new Expression('NOW()');
		if($strTypeRole == 'Adotante'){
			$this->_user->nAdotanteID = $fkModel->nAdotanteID;
		} elseif($strTypeRole == 'Protetor') {
			$this->_user->nProtetorID = $fkModel->nProtetorID;
		}
		// Falta o endereco

		// $this->_user->save();
		// return $this->login();
	}
}


?>