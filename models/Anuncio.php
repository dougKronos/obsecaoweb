<?php

namespace app\models;

use yii\db\Query;
use yii\data\ActiveDataProvider;

use Yii;

/**
 * This is the model class for table "anuncio".
 *
 * @property integer $nAnuncioID
 * @property integer $bAprovado
 * @property string $strTitulo
 * @property string $strDescricao
 * @property integer $nCaoID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Cao $nCao
 */
class Anuncio extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'anuncio';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			// [['bAprovado', 'nCaoID'], 'integer'],
			// [['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strTitulo'], 'string', 'max' => 50],
			[['strDescricao'], 'string', 'max' => 255],
			// [['nCaoID'], 'exist', 'skipOnError' => true, 'targetClass' => Cao::className(), 'targetAttribute' => ['nCaoID' => 'nCaoID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nAnuncioID' => 'N Anuncio ID',
			// 'bAprovado' => 'B Aprovado',
			'strTitulo' => 'Titulo do Anúncio:',
			'strDescricao' => 'Descricao do Anúncio:',
			'nCaoID' => 'N Cao ID',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNCao(){
		return $this->hasOne(Cao::className(), ['nCaoID' => 'nCaoID']);
	}

	public function getGridAnuncios($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())
				->select([
					 'nAnuncioID' => 'nAnuncioID',
					 'Título' => 'strTitulo',
					 'Descrição' =>'strDescricao',
					 'nCaoID' => 'nCaoID',
					 'Data Registro' => 'dtCriacao',
				])
				->from('anuncio')->where('bAprovado <> :bAprovado')->addParams([':bAprovado' => '0']),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
	
	public function getGridPermissoes($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())
				->select([
					 'nAnuncioID' => 'nAnuncioID',
					 'Título' => 'strTitulo',
					 'Descrição' =>'strDescricao',
					 'Data Registro' => 'dtCriacao',
				])
				->from('anuncio')->where('bAprovado = :bAprovado')->addParams([':bAprovado' => '0']),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
