<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_021227_anuncio_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('anuncio', [
            'nAnuncioID'             => $this->primaryKey(255),
            'bAprovado'              => Schema::TYPE_BOOLEAN,
            'strTitulo'              => $this->string(50),
            'strDescricao'           => $this->string(255),

            'nCaoID'                 => $this->integer(255),

            'dtCriacao'              => $this->datetime(),
            'dtAtualizacao'          => $this->datetime()
        ]);
        $this->addForeignKey('anuncio_cao_fk', 'anuncio', 'nCaoID', 'cao', 'nCaoID');
    }

    public function safeDown(){
        $this->dropTable('anuncio');
    }
}
