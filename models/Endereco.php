<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "endereco".
 *
 * @property integer $nEnderecoID
 * @property string $strLogradouro
 * @property integer $nNumero
 * @property string $strBairro
 * @property string $strComplemento
 * @property integer $nCidadeID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Cidade $nCidade
 * @property User[] $users
 */
class Endereco extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'endereco';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['strLogradouro'], 'required', 'on' => 'register', 'message' => 'O logradouro é obrigatório!'],
			[['nNumero'], 'required', 'on' => 'register', 'message' => 'O número é obrigatório!'],
			[['strBairro'], 'required', 'on' => 'register', 'message' => 'O bairro é obrigatório!'],
			// [['nNumero', 'nCidadeID'], 'integer'],
			[['strLogradouro'], 'string', 'max' => 100, 'on' => 'register', 'message' => 'O Máximo de caracteres permitidos é 100!'],
			[['strBairro', 'strComplemento'], 'string', 'max' => 99, 'on' => 'register', 'message' => 'O Máximo de caracteres permitidos é 99!'],
			// [['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['nCidadeID'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['nCidadeID' => 'nCidadeID']]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nEnderecoID' => 'Endereco ID',
			'strLogradouro' => 'Logradouro',
			'nNumero' => 'Número',
			'strBairro' => 'Bairro',
			'strComplemento' => 'Complemento',
			'nCidadeID' => 'Cidade ID',
			'dtCriacao' => 'Data de Registro',
			'dtAtualizacao' => 'Data de Atualização',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNCidade(){
		return $this->hasOne(Cidade::className(), ['nCidadeID' => 'nCidadeID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUsers(){
		return $this->hasMany(User::className(), ['nEnderecoID' => 'nEnderecoID']);
	}

	public function constructEstadoCidadesJSON(){
		$arrEstados = (new \yii\db\Query())
			->select(['nEstadoID', 'strUF'])
			->from('estado')->all();

		$cidades = (new \yii\db\Query())
			->select([
				'nCidadeID',
				'strNome',
				'nEstadoID'
			])
			->from('cidade')
			->all();

		$arrEstadosFinal = array();
		foreach ($arrEstados as $estado) {
			$arrCidadesTemp = [];
			foreach ($cidades as $cidade) {
				if($estado['nEstadoID'] == $cidade['nEstadoID']){
					$arrCidadesTemp[] = $cidade;
				}
			}
			$estado['cidades'] = $arrCidadesTemp;
			$arrEstadosFinal[] = $estado;
		}
		return json_encode($arrEstadosFinal);
	}
}
