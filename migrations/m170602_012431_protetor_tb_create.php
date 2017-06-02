<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_012431_protetor_tb_create extends Migration {
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('protetor', [
            'nProtetorID' => $this->primaryKey(255),
            'bRealizaEntrega' => Schema::TYPE_BOOLEAN,
            'dtCriacao' => $this->datetime(),
            'dtAtualizacao' => $this->datetime()
        ]);
    }

    public function safeDown(){
        $this->dropTable('protetor');
    }
}
