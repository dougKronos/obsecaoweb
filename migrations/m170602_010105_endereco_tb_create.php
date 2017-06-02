<?php

use yii\db\Migration;

class m170602_010105_endereco_tb_create extends Migration {
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('endereco', [
            'nEnderecoID' => $this->primaryKey(255),
            'strLogradouro' => $this->string(100),
            'nNumero' => $this->integer(255),
            'strBairro' => $this->string(99),
            'strComplemento' => $this->string(99),
            'nCidadeID' => $this->integer(255),
            'dtCriacao' => $this->datetime(),
            'dtAtualizacao' => $this->datetime()
        ]);
        $this->addForeignKey('endereco_cidade_fk', 'endereco', 'nCidadeID', 'cidade', 'nCidadeID');
    }

    public function safeDown(){
        $this->dropTable('endereco');
    }
}
