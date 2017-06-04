<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "noticia".
 *
 * @property integer $nNoticiaID
 * @property string $strTopico
 * @property string $strDescricao
 * @property integer $nAdministradorID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Administrador $nAdministrador
 */
class Noticia extends \yii\db\ActiveRecord{

	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'noticia';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['nAdministradorID'], 'required'],
			[['nAdministradorID'], 'integer'],
			[['dtCriacao', 'dtAtualizacao'], 'safe'],
			[['strTopico'], 'string', 'max' => 50],
			[['strDescricao'], 'string', 'max' => 255],
			[['nAdministradorID'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['nAdministradorID' => 'nAdministradorID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nNoticiaID' => 'N Noticia ID',
			'strTopico' => 'Str Topico',
			'strDescricao' => 'Str Descricao',
			'nAdministradorID' => 'N Administrador ID',
			'dtCriacao' => 'Dt Criacao',
			'dtAtualizacao' => 'Dt Atualizacao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNAdministrador(){
		return $this->hasOne(Administrador::className(), ['nAdministradorID' => 'nAdministradorID']);
	}

	public function getGridNoticias($nPagination){
		return new ActiveDataProvider([
			'query' => (new Query())->from('noticia'),
			'pagination' => [
				'pageSize' => $nPagination,
			],
		]);
	}
}
