<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_014529_cao_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('cao', [
            'nCaoID'             => $this->primaryKey(255),
            'strNome'            => $this->string(50),
            'cSexo'              => Schema::TYPE_CHAR,
            'strRaca'            => $this->string(50),
            'nIdadeAno'          => $this->integer(2),
            'nIdadeMes'          => $this->integer(2),
            'strCaracteristicas' => $this->integer(255),
            'strComportamentais' => $this->integer(255),
            'strNomeFoto'        => $this->string(100),

            'nProtetorID'        => $this->integer(255) . ' NOT NULL',
            'nAdotanteID'        => $this->integer(255),
            
            'dtCriacao'          => $this->datetime(),
            'dtAtualizacao'      => $this->datetime()
        ]);
        $this->addForeignKey('cao_protetor_fk', 'cao', 'nProtetorID', 'protetor', 'nProtetorID');
        $this->addForeignKey('cao_adotante_fk', 'cao', 'nAdotanteID', 'adotante', 'nAdotanteID');
    }

    public function safeDown(){
        $this->dropTable('cao');
    }
}
