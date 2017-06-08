<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cao".
 *
 * @property integer $nCaoID
 * @property string $strNome
 * @property string $cSexo
 * @property string $strRaca
 * @property integer $nIdadeAno
 * @property integer $nIdadeMes
 * @property integer $strCaracteristicas
 * @property integer $strComportamentais
 * @property string $strNomeFoto
 * @property integer $nProtetorID
 * @property integer $nAdotanteID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Anuncio[] $anuncios
 * @property Adotante $nAdotante
 * @property Protetor $nProtetor
 * @property Depoimento[] $depoimentos
 * @property Recusa[] $recusas
 */
class Cao extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'cao';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			// [['nIdadeAno', 'nIdadeMes', 'strCaracteristicas', 'strComportamentais', 'nProtetorID'], 'integer'],
			// [['nProtetorID'], 'required'],
			// [['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strNome', 'strRaca'], 'string', 'max' => 50],
			[['cSexo'], 'string', 'max' => 1],
			[['strNomeFoto'], 'string', 'max' => 100],
			// [['nAdotanteID'], 'exist', 'skipOnError' => true, 'targetClass' => Adotante::className(), 'targetAttribute' => ['nAdotanteID' => 'nAdotanteID']],
			// [['nProtetorID'], 'exist', 'skipOnError' => true, 'targetClass' => Protetor::className(), 'targetAttribute' => ['nProtetorID' => 'nProtetorID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nCaoID' => 'N Cao ID',
			'strNome' => 'Str Nome',
			'cSexo' => 'C Sexo',
			'strRaca' => 'Str Raca',
			'nIdadeAno' => 'N Idade Ano',
			'nIdadeMes' => 'N Idade Mes',
			'strCaracteristicas' => 'Str Caracteristicas',
			'strComportamentais' => 'Str Comportamentais',
			'strNomeFoto' => 'Str Nome Foto',
			'nProtetorID' => 'N Protetor ID',
			'nAdotanteID' => 'N Adotante ID',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAnuncios(){
		return $this->hasMany(Anuncio::className(), ['nCaoID' => 'nCaoID']);
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
	public function getNProtetor(){
		return $this->hasOne(Protetor::className(), ['nProtetorID' => 'nProtetorID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDepoimentos(){
		return $this->hasMany(Depoimento::className(), ['nCaoID' => 'nCaoID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRecusas(){
		return $this->hasMany(Recusa::className(), ['nCaoID' => 'nCaoID']);
	}

	public function getGridCaes($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())
				->select([
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
				])
				->from('{{cao}}')
				->join('INNER JOIN', 'protetor', 'cao.nProtetorID = protetor.nProtetorID')
				->join('INNER JOIN', 'user', 'user.nProtetorID = protetor.nProtetorID')
				->join('LEFT JOIN', 'adotante', 'cao.nAdotanteID = adotante.nAdotanteID')
				->join('LEFT JOIN', 'user AS userAdotante', 'userAdotante.nAdotanteID = adotante.nAdotanteID'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
