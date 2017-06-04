<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidade".
 *
 * @property integer $nCidadeID
 * @property string $strNome
 * @property integer $nEstadoID
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 *
 * @property Estado $nEstado
 * @property Endereco[] $enderecos
 */
class Cidade extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['nEstadoID'], 'required'],
            [['nEstadoID'], 'integer'],
            [['dtCriacao', 'dtAtualizacao'], 'safe'],
            [['strNome'], 'string', 'max' => 50],
            [['nEstadoID'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['nEstadoID' => 'nEstadoID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'nCidadeID' => 'N Cidade ID',
            'strNome' => 'Str Nome',
            'nEstadoID' => 'N Estado ID',
            'dtCriacao' => 'Dt Criacao',
            'dtAtualizacao' => 'Dt Atualizacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNEstado(){
        return $this->hasOne(Estado::className(), ['nEstadoID' => 'nEstadoID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecos(){
        return $this->hasMany(Endereco::className(), ['nCidadeID' => 'nCidadeID']);
    }
}
