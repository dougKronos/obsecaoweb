<?php

use yii\db\Migration;

class m170602_003529_cidade_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('cidade', [
            'nCidadeID' => $this->primaryKey(255),
            'strNome' => $this->string(50),
            'nEstadoID' => $this->integer(255) . ' NOT NULL',
            'dtCriacao' => $this->datetime(),
            'dtAtualizacao' => $this->datetime()
        ]);
        $this->addForeignKey('cidade_estado_fk', 'cidade', 'nEstadoID', 'estado', 'nEstadoID');
    }

    public function safeDown(){
        $this->dropTable('cidade');        
    }
}
