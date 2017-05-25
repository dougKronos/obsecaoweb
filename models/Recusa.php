<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recusa".
 *
 * @property integer $nRecusaID
 * @property string $strTitulo
 * @property string $strDescricao
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 */
class Recusa extends \yii\db\ActiveRecord
{
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
            [['dtCriacao', 'dtAtualizacao'], 'safe'],
            [['strTitulo'], 'string', 'max' => 50],
            [['strDescricao'], 'string', 'max' => 255],
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
            'dtCriacao' => 'Dt Criacao',
            'dtAtualizacao' => 'Dt Atualizacao',
        ];
    }
}
