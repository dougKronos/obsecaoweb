<?php

namespace app\models;

use Yii;

use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "protetor".
 *
 * @property integer $nProtetorID
 * @property integer $bRealizaEntrega
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Cao[] $caos
 * @property User[] $users
 */
class Protetor extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'protetor';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['bRealizaEntrega'], 'required', 'on' => 'register'],
			[['bRealizaEntrega'], 'integer', 'on' => 'register']
			// [['dtCriacao', 'dtAtualizacao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nProtetorID' => 'ID Protetor',
			'bRealizaEntrega' => 'Realiza entrega',
			'dtCriacao' => 'Data de Registro',
			'dtAtualizacao' => 'Data de Atualização',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCaos(){
		return $this->hasMany(Cao::className(), ['nProtetorID' => 'nProtetorID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUsers(){
		return $this->hasMany(User::className(), ['nProtetorID' => 'nProtetorID']);
	}

	public function getGridCaos($nPagination, $nProtetorID){
		return new ActiveDataProvider([
			'query' => (new Query())
				->select([
					'nCaoID' => "cao.nCaoID",
					'Nome' => "cao.strNome",
					'Sexo' => "CASE {{cao}}.[[cSexo]] WHEN 'F' THEN 'Feminino' ELSE 'Masculino' END",
					'Raca' => "cao.strRaca",
					'nIdadeAno' => "cao.nIdadeAno",
					'nIdadeMes' => "cao.nIdadeMes",
					'Status Fisico' => "CASE {{cao}}.[[strCaracteristicas]] WHEN '0' THEN '--' ELSE {{cao}}.[[strCaracteristicas]] END",
					'Comportamental' => "CASE {{cao}}.[[strComportamentais]] WHEN '0' THEN '--' ELSE {{cao}}.[[strComportamentais]] END",
					'Foto' => "cao.strNomeFoto",
					'Nome Protetor' => "{{user}}.[[strNome]]",
					'Adotante' => "CASE WHEN {{cao}}.[[nAdotanteID]] IS NULL THEN 'Não Possui' ELSE {{userAdotante}}.[[strNome]] END",
					'Adotado' => "CASE WHEN {{cao}}.[[nAdotanteID]] IS NULL THEN 'Não' ELSE 'Sim' END",
				])
				->from('protetor')
				->join('INNER JOIN', 'cao', 'cao.nProtetorID = protetor.nProtetorID')
				->join('INNER JOIN', 'user', 'user.nProtetorID = protetor.nProtetorID')
				->join('LEFT JOIN', 'adotante', 'cao.nAdotanteID = adotante.nAdotanteID')
				->join('LEFT JOIN', 'user AS userAdotante', 'userAdotante.nAdotanteID = adotante.nAdotanteID')
				->where(
					'cao.nProtetorID = :nProtetorID'
				)
				->addParams([':nProtetorID' => $nProtetorID]),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}

	public function getGridProtetores($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())
				->select([
					'Data Registro' => 'protetor.dtCriacao',
					'nProtetorID' => 'protetor.nProtetorID',
					'Nome' => 'user.strNome',
					'Email' => 'user.email',
					'Telefone' => 'user.strTelefone',
					'Realiza Entrega' => 'IF(protetor.bRealizaEntrega="1","Sim","Não")'
				])
				->from('protetor')
				->join('INNER JOIN', 'user', 'user.nProtetorID = protetor.nProtetorID'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
