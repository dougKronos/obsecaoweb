<?php

namespace app\models;

use Yii;

use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "administrador".
 *
 * @property integer $nAdministradorID
 * @property string $strNivelGerencial
 * @property integer $nUsuarioID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property User $nUsuario
 * @property Noticia[] $noticias
 */
class Administrador extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'administrador';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['nUsuarioID'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strNivelGerencial'], 'string', 'max' => 100],
			[['nUsuarioID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nUsuarioID' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nAdministradorID' => 'N Administrador ID',
			'strNivelGerencial' => 'Str Nivel Gerencial',
			'nUsuarioID' => 'N Usuario ID',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNUsuario(){
		return $this->hasOne(User::className(), ['id' => 'nUsuarioID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNoticias(){
		return $this->hasMany(Noticia::className(), ['nAdministradorID' => 'nAdministradorID']);
	}

	public function getGridAdministradores($nPagination){
		$dataQuery = (new Query())
				->select([
					'user.strNome AS Nome',
					'user.email',
					"admin.strNivelGerencial",
					'user.strTelefone AS Telefone'
				])
				->from('user')
				->join('INNER JOIN', 'administrador AS admin', 'user.id = admin.nUsuarioID');


		return new ActiveDataProvider([
			'query' => $dataQuery,
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
