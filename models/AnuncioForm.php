<?php

namespace app\models;

use yii\web\UploadedFile;

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
class AnuncioForm extends \yii\base\Model{

	/**
     * @var UploadedFile
     */
    public $imageFile;

	public $strTitulo;
	public $strDescricao;
	public $strNome;
	public $strRaca;

	public $cSexo;

	public $nIdadeAno;
	public $nIdadeMes;
	public $strCaracteristicas;
	public $strComportamentais;

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
			[['imageFile'], 'validateImage', 'on' => 'register'],

			[['strTitulo'], 'required', 'on' => 'register', 'message' => 'O título é obrigatório!'],
			[['strDescricao'], 'required', 'on' => 'register', 'message' => 'A descrição é obrigatória!'],
			[['strTitulo'], 'string', 'max' => 50, 'on' => 'register', 'message' => 'O máximo de carateres é 50!'],
			[['strDescricao'], 'string', 'max' => 255, 'on' => 'register', 'message' => 'O máximo de carateres é 255!'],
			// [['nCaoID'], 'exist', 'skipOnError' => true, 'targetClass' => Cao::className(), 'targetAttribute' => ['nCaoID' => 'nCaoID']],

			[['strNome'], 'required', 'on' => 'register', 'message' => 'O nome do cão é obrigatório!'],

			[['strRaca'], 'required', 'on' => 'register', 'message' => 'A raça do cão é obrigatória!'],

			[['nIdadeAno'], 'required', 'on' => 'register', 'message' => 'Os anos de idade do cão são obrigatórios!'],
			[['nIdadeMes'], 'required', 'on' => 'register', 'message' => 'Os meses de idade do cão são obrigatórios!'],

			[['strCaracteristicas'], 'required', 'on' => 'register', 'message' => 'As características físicas do cão são obrigatórias!'],
			[['strComportamentais'], 'required', 'on' => 'register', 'message' => 'As características comportamentais do cão são obrigatórias!'],

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'nAnuncioID' => Yii::t('app', 'N Anuncio ID'),
			'bAprovado' => Yii::t('app', 'B Aprovado'),
			'strTitulo' => Yii::t('app', 'Título do Anúncio:'),
			'strDescricao' => Yii::t('app', 'Descrição do Anúncio:'),
			'nCaoID' => Yii::t('app', 'N Cao ID'),
			'dtCriacao' => Yii::t('app', 'Dt Criacao'),
			'dtAtualizacao' => Yii::t('app', 'Dt Atualizacao'),

			'strNome' => Yii::t('app', 'Nome do cão:'),
			'strRaca' => Yii::t('app', 'Raça do cão:'),
			'cSexo' => Yii::t('app', 'Sexo do cão:'),
			'nIdadeAno' => Yii::t('app', 'Anos de idade do cão:'),
			'nIdadeMes' => Yii::t('app', 'Meses de idade do cão:'),

			'strCaracteristicas' => Yii::t('app', 'Características Físicas:'),
			'strComportamentais' => Yii::t('app', 'Características Comportamentais:'),
		];
	}

	public function validateImage($attributes, $params){
		$this->imageFile = UploadedFile::getInstance($this, 'imageFile');
		if(is_string($this->imageFile) && !empty($this->imageFile)){
			return true;
		} else {
			$this->addError('imageFile', 'O envio de foto é obrigatório!');
		}
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getNCao(){
		return $this->hasOne(Cao::className(), ['nCaoID' => 'nCaoID']);
	}

	public function uploadPhoto() {
		if($this->getQtdCao() > 0)
			$number = $this->getLastCao()+1;
		else
			$number = 1;

		$this->imageFile = UploadedFile::getInstance($this, 'imageFile');

		$strPhotoName = "anuncio$number.".$this->imageFile->extension;
		// exit(var_dump(\Yii::getAlias('@app')."/web/images/fotosAnuncios/$strPhotoName"));
		$result = $this->imageFile->saveAs(\Yii::getAlias('@app')."/web/images/fotosAnuncios/$strPhotoName");
		if(!$result){
			return false;
		}
		return $strPhotoName;
	}

	public function getQtdCao(){
		return \Yii::$app->db
		    ->createCommand('SELECT COUNT(*) FROM cao;')
		    ->queryScalar();
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
