<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_013023_adotante_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('adotante', [
            'nAdotanteID'      => $this->primaryKey(255),
            'strDetalhesLocal' => $this->string(255),
            'bPossuiCriancas'  => Schema::TYPE_BOOLEAN,
            'bPossuiPets'      => Schema::TYPE_BOOLEAN,
            'bAdotouAntes'     => Schema::TYPE_BOOLEAN,
            'dtCriacao'        => $this->datetime(),
            'dtAtualizacao'    => $this->datetime()
        ]);
    }

    public function safeDown(){
        $this->dropTable('adotante');
    }
}
