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
			[['bPossuiCriancas', 'bPossuiPets', 'bAdotouAntes'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strDetalhesLocal'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nAdotanteID' => 'N Adotante ID',
			'strDetalhesLocal' => 'Str Detalhes Local',
			'bPossuiCriancas' => 'B Possui Criancas',
			'bPossuiPets' => 'B Possui Pets',
			'bAdotouAntes' => 'B Adotou Antes',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
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
