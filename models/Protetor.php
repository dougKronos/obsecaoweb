<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "protetor".
 *
 * @property integer $nProtetorID
 * @property integer $bRealizaEntrega
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 */
class Protetor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'protetor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bRealizaEntrega'], 'integer'],
            [['dtCriacao', 'dtAtualizacao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nProtetorID' => 'N Protetor ID',
            'bRealizaEntrega' => 'B Realiza Entrega',
            'dtCriacao' => 'Dt Criacao',
            'dtAtualizacao' => 'Dt Atualizacao',
        ];
    }
}
