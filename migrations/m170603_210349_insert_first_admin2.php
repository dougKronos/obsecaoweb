<?php

use yii\db\Migration;
use yii\db\Query;
use yii\db\Expression;

class m170603_210349_insert_first_admin2 extends Migration{
	
	/*public function up(){

	}

	public function down() {
		echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
		return false;
	}*/

	
	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp(){

		$usuario = (new Query())
		->select(['id'])
		->from('user')
		->where([
			'email' => 'douglas.gtads@gmail.com'
		])->one();

		$nUsuarioID = $usuario['id'];

		\Yii::$app->db
			->createCommand()
			->insert('administrador', [
				'strNivelGerencial' => 'Diretoria',
				'nUsuarioID'        => $nUsuarioID,
				'dtCriacao'         => new Expression('NOW()'),
				'dtAtualizacao'     => new Expression('NOW()')
			])->execute();
	}

	public function safeDown(){
		$usuario = (new Query())
		->select(['id'])
		->from('user')
		->where([
			'email' => 'douglas.gtads@gmail.com'
		])->one();

		$nUsuarioID = $usuario['id'];


		$command = \Yii::$app
				->db
				->createCommand(
					"DELETE FROM administrador WHERE nUsuarioID='$nUsuarioID'"
				)->execute();
	}
}