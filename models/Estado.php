<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property integer $nEstadoID
 * @property string $strNome
 * @property string $strUF
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Cidade[] $cidades
 */
class Estado extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'estado';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strNome'], 'string', 'max' => 50],
			[['strUF'], 'string', 'max' => 2],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nEstadoID' => 'N Estado ID',
			'strNome' => 'Str Nome',
			'strUF' => 'Str Uf',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCidades(){
		return $this->hasMany(Cidade::className(), ['nEstadoID' => 'nEstadoID']);
	}
}
