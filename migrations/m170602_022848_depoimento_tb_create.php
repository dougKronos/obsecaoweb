<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_022848_depoimento_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('depoimento', [
            'nDepoimentoID'             => $this->primaryKey(255),
            'strDepoimento'             => $this->string(255),
            'bAprovacao'          => Schema::TYPE_BOOLEAN . ' DEFAULT 0',

            'nAdotanteID'         => $this->integer(255) . ' NOT NULL',
            'nCaoID'                 => $this->integer(255) . ' NOT NULL',

            'dtCriacao'              => $this->datetime(),
            'dtAtualizacao'          => $this->datetime()
        ]);
        $this->addForeignKey('depoimento_adotante_fk', 'depoimento', 'nAdotanteID', 'adotante', 'nAdotanteID');
        $this->addForeignKey('depoimento_cao_fk', 'depoimento', 'nCaoID', 'cao', 'nCaoID');
    }

    public function safeDown(){
        $this->dropTable('depoimento');
    }
}
