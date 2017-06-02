<?php

use yii\db\Migration;

class m170602_025349_administrador_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('administrador', [
            'nAdministradorID'      => $this->primaryKey(255),
            'strNivelGerencial'     => $this->string(100),

            'nUsuarioID'       => $this->integer(255),

            'dtCriacao'        => $this->datetime(),
            'dtAtualizacao'    => $this->datetime()
        ]);
        $this->addForeignKey('admin_user_fk', 'administrador', 'nUsuarioID', 'user', 'id');
    }

    public function safeDown(){
        $this->dropTable('administrador');
    }
}
