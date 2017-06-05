<?php

namespace app\models;

use Yii;

use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "adotante".
 *
 * @property integer $nAdotanteID
 * @property string $strDetalhesLocal
 * @property integer $bPossuiCriancas
 * @property integer $bPossuiPets
 * @property integer $bAdotouAntes
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Cao[] $caos
 * @property Depoimento[] $depoimentos
 * @property Recusa[] $recusas
 * @property User[] $users
 */
class Adotante extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'adotante';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['strDetalhesLocal'], 'string', 'max' => 255, 'on' => 'register'],
			[['strDetalhesLocal', 'bPossuiCriancas', 'bPossuiPets', 'bAdotouAntes'], 'required', 'on' => 'register'],
			[['bPossuiCriancas', 'bPossuiPets', 'bAdotouAntes'], 'integer', 'on' => 'register']
			// [['dtCriacao', 'dtAtualizacao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nAdotanteID' => 'ID Adotante',
			'strDetalhesLocal' => 'Detalhes da moradia do adotante',
			'bPossuiCriancas' => 'Possui Criancas?',
			'bPossuiPets' => 'Já Possui Pets?',
			'bAdotouAntes' => 'Já adotou antes?',
			
			'dtCriacao' => 'Data de Registro',
			'dtAtualizacao' => 'Data de Atualização',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCaos(){
		return $this->hasMany(Cao::className(), ['nAdotanteID' => 'nAdotanteID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDepoimentos(){
		return $this->hasMany(Depoimento::className(), ['nAdotanteID' => 'nAdotanteID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRecusas(){
		return $this->hasMany(Recusa::className(), ['nAdotanteID' => 'nAdotanteID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUsers(){
		return $this->hasMany(User::className(), ['nAdotanteID' => 'nAdotanteID']);
	}

	public function getGridAdotantes($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('adotante'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
