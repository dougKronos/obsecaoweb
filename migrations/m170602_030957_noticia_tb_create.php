<?php

use yii\db\Migration;

class m170602_030957_noticia_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('noticia', [
            'nNoticiaID'      => $this->primaryKey(255),
            'strTopico'       => $this->string(50),
            'strDescricao'       => $this->string(255),

            'nAdministradorID'       => $this->integer(255) . ' NOT NULL',

            'dtCriacao'        => $this->datetime(),
            'dtAtualizacao'    => $this->datetime()
        ]);
        $this->addForeignKey('news_admin_fk', 'noticia', 'nAdministradorID', 'administrador', 'nAdministradorID');
    }

    public function safeDown(){
        $this->dropTable('noticia');
    }
}
