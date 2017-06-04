<?php

namespace app\models;

use Yii;

use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $strNome
 * @property string $email
 * @property string $emailAlternativo
 * @property string $strSenha
 * @property string $strTelefone
 * @property string $strTelefoneAlternativo
 * @property integer $nProtetorID
 * @property integer $nAdotanteID
 * @property integer $nEnderecoID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Administrador[] $administradors
 * @property Adotante $nAdotante
 * @property Endereco $nEndereco
 * @property Protetor $nProtetor
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['strNome', 'email', 'strSenha', 'strTelefone', 'nEnderecoID', 'dtCriacao', 'dtAtualizacao'], 'required'],
			[['nProtetorID', 'nAdotanteID', 'nEnderecoID'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strNome', 'email', 'emailAlternativo'], 'string', 'max' => 100],
			[['strSenha'], 'string', 'max' => 255],
			[['strTelefone', 'strTelefoneAlternativo'], 'string', 'max' => 30],
			[['email'], 'unique'],
			[['nAdotanteID'], 'exist', 'skipOnError' => true, 'targetClass' => Adotante::className(), 'targetAttribute' => ['nAdotanteID' => 'nAdotanteID']],
			[['nEnderecoID'], 'exist', 'skipOnError' => true, 'targetClass' => Endereco::className(), 'targetAttribute' => ['nEnderecoID' => 'nEnderecoID']],
			[['nProtetorID'], 'exist', 'skipOnError' => true, 'targetClass' => Protetor::className(), 'targetAttribute' => ['nProtetorID' => 'nProtetorID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'                     => 'ID',
			'strNome'                => 'Nome',
			'email'                  => 'Email',
			'emailAlternativo'       => 'Email Alternativo',
			'strSenha'               => 'Senha',
			'strTelefone'            => 'Telefone',
			'strTelefoneAlternativo' => 'Telefone Alt.',
			'nProtetorID'            => 'Protetor',
			'nAdotanteID'            => 'Adotante',
			'nEnderecoID'            => 'Endereco',
			'dtCriacao'              => 'Data de cadastro',
			'dtAtualizacao'          => 'Data de atualização',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAdministradors(){
		return $this->hasMany(Administrador::className(), ['nUsuarioID' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNAdotante(){
		return $this->hasOne(Adotante::className(), ['nAdotanteID' => 'nAdotanteID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNEndereco(){
		return $this->hasOne(Endereco::className(), ['nEnderecoID' => 'nEnderecoID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNProtetor(){
		return $this->hasOne(Protetor::className(), ['nProtetorID' => 'nProtetorID']);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id){
		return static::findOne($id);
		// return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
	}

	/**
	* @inheritdoc
	*/
	public static function findIdentityByAccessToken($token, $type=null) {
		//...
	}

	/**
	* @inheritdoc
	*/
	public function getId(){
		return $this->id;
	}

	/**
	* @return string current user auth key
	*/
	public function getAuthKey() {
		//...
	}

	/**
	* @param string $authKey
	* @return boolean if auth key is valid for current user
	*/
	public function validateAuthKey($authKey){
		return true;
	}

	/**
	* Validates password
	*
	* @param string $strSenha password to validate
	* @return boolean if password provided is valid for current user
	*/
	public function validatePassword($strSenha)		{
		return password_verify($strSenha, $this->strSenha);
	}

	public function isAdministrador(){
		return $this->getAdministradorQuery()->count() > 0;
	}

	public function isDiretor(){
		$admin = $this->getAdministradorQuery()->one();
		return isset($admin) && $admin->strNivelGerencial == 'Diretoria';
	}

	public function getAdministradorQuery(){
		return Administrador::find()->where(['nUsuarioID' => $this->getId()]);
	}

	public function getGridUsers($nPagination){
		$dataQuery = (new Query())
				->select([
					'user.id',
					'user.strNome AS Nome',
					'user.email',
					"IF(admin.nUsuarioID IS NOT NULL,'Sim','Não') AS Administrador",
					"IF(nAdotanteID IS NOT NULL,'Sim','Não') AS Adotante",
					"IF(nProtetorID IS NOT NULL,'Sim','Não') AS Protetor",
					'strTelefone AS Telefone'
				])
				->from('user')
				->join('LEFT JOIN', 'administrador AS admin', 'user.id = admin.nUsuarioID');


		return new ActiveDataProvider([
			'query' => $dataQuery,
				'pagination' => [
					'pageSize' => $nPagination,
				],
		]);
	}
}
