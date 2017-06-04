<?php 

namespace app\models;

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

	public $strTypeRole;

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
			[['email'], 'unique', 'on' => 'register'],
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

		];
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
}


?>