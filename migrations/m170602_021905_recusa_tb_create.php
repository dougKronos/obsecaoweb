<?php

use yii\db\Migration;

class m170602_021905_recusa_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('recusa', [
            'nRecusaID'             => $this->primaryKey(255),
            'strTitulo'              => $this->string(50),
            'strDescricao'           => $this->string(255),

            'nCaoID'                 => $this->integer(255) . ' NOT NULL',
            'nAdotanteID'            => $this->integer(255) . ' NOT NULL',

            'dtCriacao'              => $this->datetime(),
            'dtAtualizacao'          => $this->datetime()
        ]);
        $this->addForeignKey('recusa_cao_fk', 'recusa', 'nCaoID', 'cao', 'nCaoID');
        $this->addForeignKey('recusa_adotante_fk', 'recusa', 'nAdotanteID', 'adotante', 'nAdotanteID');
    }

    public function safeDown(){
        $this->dropTable('recusa');
    }
}
