<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permissao".
 *
 * @property integer $nPermissaoID
 * @property string $strDescricao
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 */
class Permissao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permissao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dtCriacao', 'dtAtualizacao'], 'safe'],
            [['strDescricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nPermissaoID' => 'N Permissao ID',
            'strDescricao' => 'Str Descricao',
            'dtCriacao' => 'Dt Criacao',
            'dtAtualizacao' => 'Dt Atualizacao',
        ];
    }
}
