<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "depoimento".
 *
 * @property integer $nDepoimentoID
 * @property string $strDepoimento
 * @property integer $bAprovacao
 * @property integer $nAdotanteID
 * @property integer $nCaoID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Adotante $nAdotante
 * @property Cao $nCao
 */
class Depoimento extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'depoimento';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['bAprovacao', 'nAdotanteID', 'nCaoID'], 'integer'],
			[['nAdotanteID', 'nCaoID'], 'required'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strDepoimento'], 'string', 'max' => 255],
			[['nAdotanteID'], 'exist', 'skipOnError' => true, 'targetClass' => Adotante::className(), 'targetAttribute' => ['nAdotanteID' => 'nAdotanteID']],
			[['nCaoID'], 'exist', 'skipOnError' => true, 'targetClass' => Cao::className(), 'targetAttribute' => ['nCaoID' => 'nCaoID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nDepoimentoID' => 'N Depoimento ID',
			'strDepoimento' => 'Str Depoimento',
			'bAprovacao' => 'B Aprovacao',
			'nAdotanteID' => 'N Adotante ID',
			'nCaoID' => 'N Cao ID',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
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
	public function getNCao(){
		return $this->hasOne(Cao::className(), ['nCaoID' => 'nCaoID']);
	}

	public function getGridDepoimentos($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('depoimento'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
	
	public function getGridPermissoes($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('depoimento')->where(['bAprovacao' => '1']),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
