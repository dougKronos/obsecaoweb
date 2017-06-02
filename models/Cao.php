<?php

namespace app\models;

use Yii;
use \yii\db\Query;
use yii\web\UploadedFile;

/**
 * This is the model class for table "cao".
 *
 * @property integer $nCaoID
 * @property string $strNome
 * @property string $cSexo
 * @property string $strRaca
 * @property string $nIdade
 * @property string $strCaracteristicas
 * @property string $strCaracteristicasComport
 * @property string $strNomeFoto
 * @property string $dtCriacao
 * @property string $dtAtualizacao
 */
class Cao extends \yii\db\ActiveRecord {

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cao';
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['strCaracteristicas', 'strCaracteristicasComport'], 'required', 'message' => 'Campo Obrigatório!'],
            [['strNome', 'strRaca'], 'string', 'max' => 50],
            [['cSexo'], 'string', 'max' => 1],
            [['strNome'], 'required', 'message' => 'Digite um nome.'],
            [['cSexo'], 'required', 'message' => 'Escolha um sexo.'],
            [['strRaca'], 'required', 'message' => 'Digite o nome da Raça ou "Vira-lata".'],
            
            [['nIdadeMeses'], 'required', 'message' => 'Digite a idade em meses.'],            

            [['nIdadeAnos'], 'required', 'message' => 'Digite a idade em anos.'],
            [['nIdadeAnos', 'nIdadeMeses'], 'string', 'max' => 25],
            
            [['strCaracteristicas', 'strCaracteristicasComport'], 'string', 'max' => 255],
            [['imageFile'], 'required', 'message' => 'Selecione uma foto.'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * @inheritdoc
     */
    // public function rules() {
    //     return [
    //         [['dtCriacao', 'dtAtualizacao'], 'safe'],
    //         [['strNome', 'strRaca'], 'string', 'max' => 50],
    //         [['cSexo'], 'string', 'max' => 1],
    //         [['nIdade'], 'string', 'max' => 25],
    //         [['strCaracteristicas', 'strCaracteristicasComport'], 'string', 'max' => 255],
    //         [['strNomeFoto'], 'string', 'max' => 70],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'nCaoID' => 'CaoID',
            'strNome' => 'Nome',
            'cSexo' => 'Sexo',
            'strRaca' => 'Raça',
            'nIdadeAnos' => 'Anos de Idade',
            'nIdadeMeses' => 'Meses de Idade',
            'strCaracteristicas' => 'Caracteristicas Físicas',
            'strCaracteristicasComport' => 'Caracteristicas Comportamentais',
            'strNomeFoto' => 'NomeFoto',
            'dtCriacao' => 'Data de Cadastro',
            'dtAtualizacao' => 'Data de Atualizacao',
            'imageFile' => 'Foto do Cão'
        ];
    }

    /*
    *  Retorna todos os caes do banco de dados
    */
    public function listAll(){
        $caninos = (new Query())
                ->select([
                    'nCaoID',
                    'strNome',
                    'cSexo',
                    'strRaca',
                    'nIdadeAnos',
                    'nIdadeMeses',
                    'strCaracteristicas',
                    'strCaracteristicasComport',
                    'strNomeFoto'
                ])
                ->from('cao')
                ->orderBy('dtCriacao ASC')
                ->all();

        $items = [];

        function defineSex($cao){
            return $cao['cSexo'] == 'M' ? 'Macho' : 'Fêmea';
        }

        foreach ($caninos as $cao){
            $cao['cSexo'] = defineSex($cao);
        }
        return $caninos;
    }

    public function upload() {
       // if ($this->validate()) {
       //     exit('Foi 2');
           // $number = $this->getLastCao() + 1;
           $number = $this->getLastCao()+1;
           // exit(\Yii::getAlias('@app'));
           // exit(var_dump($this->imageFile));
           // exit(var_dump($this['imageFile'][0]));
           $this->imageFile->saveAs(\Yii::getAlias('@app').'/web/images/fotosAnuncios/anuncio' . "$number." . $this->imageFile->extension);
           return true;
       // } else {
       //     return false;
       // }
   }

    public function getLastCao(){
        return \Yii::$app->db
            ->createCommand('SELECT MAX(nCaoID) FROM cao;')
            ->queryScalar();

        // return (new Query())
                // ->select([
                    // 'MAX(nCaoID)'
                // ])
                // ->from('cao')
                // ->queryScalar();
    }
}