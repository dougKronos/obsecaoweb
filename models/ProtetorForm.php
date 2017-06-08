<?php

namespace app\models;

use yii\db\Query;
use yii\db\Expression;

/**
* UserForm
*/
class ProtetorForm extends \yii\base\Model{

	public $nAdotanteID;

	public function rules(){
		return [
			[['nAdotanteID'], 'required', 'on' => 'adocao', 'message' => 'O adotante é obrigatório!'],
			[['dtAdocao'], 'required', 'on' => 'adocao', 'message' => 'A data de adocão é obrigatória!']
		];
	}

	public function adotar($nAdotanteID, $dtAdocao){
		exit('Foi');
	}
}
?>