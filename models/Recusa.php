<?php

namespace app\models;

use Yii;

use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "recusa".
 *
 * @property integer $nRecusaID
 * @property string $strTitulo
 * @property string $strDescricao
 * @property integer $nCaoID
 * @property integer $nAdotanteID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Adotante $nAdotante
 * @property Cao $nCao
 */
class Recusa extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'recusa';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['nCaoID', 'nAdotanteID'], 'required'],
			[['nCaoID', 'nAdotanteID'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strTitulo'], 'string', 'max' => 50],
			[['strDescricao'], 'string', 'max' => 255],
			[['nAdotanteID'], 'exist', 'skipOnError' => true, 'targetClass' => Adotante::className(), 'targetAttribute' => ['nAdotanteID' => 'nAdotanteID']],
			[['nCaoID'], 'exist', 'skipOnError' => true, 'targetClass' => Cao::className(), 'targetAttribute' => ['nCaoID' => 'nCaoID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nRecusaID' => 'N Recusa ID',
			'strTitulo' => 'Str Titulo',
			'strDescricao' => 'Str Descricao',
			'nCaoID' => 'N Cao ID',
			'nAdotanteID' => 'N Adotante ID',
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

	public function getGridRecusas($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('recusa'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
