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
			[['bRealizaEntrega'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nProtetorID' => 'N Protetor ID',
			'bRealizaEntrega' => 'B Realiza Entrega',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
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

	public function getGridProtetores($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('protetor'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
