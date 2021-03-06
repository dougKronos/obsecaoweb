<?php

use yii\db\Migration;

class m170602_003520_estado_tb_create extends Migration {
	
	/*public function up(){

	}

	public function down() {
		echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
		return false;
	}*/

	
	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp(){
		$this->createTable('estado', [
			'nEstadoID' => $this->primaryKey(255),
			'strNome' => $this->string(50),
			'strUF' => $this->string(2),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);
	}

	public function safeDown(){
		$this->dropTable('estado');
	}
}
