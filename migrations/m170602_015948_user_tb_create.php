<?php

use yii\db\Migration;
use yii\db\Schema;

class m170602_015948_user_tb_create extends Migration{
    
    /*public function up(){

    }

    public function down() {
        echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
        return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $this->createTable('user', [
            'id'                     => $this->primaryKey(255),
            'strNome'                => $this->string(100),
            'email'                  => $this->string(100),
            'emailAlternativo'       => $this->string(100),
            'strSenha'               => $this->string(255),
            'strTelefone'            => $this->string(30),
            'strTelefoneAlternativo' => $this->string(30),
            'nProtetorID'            => $this->integer(255),
            'nAdotanteID'            => $this->integer(255),
            'nEnderecoID'            => $this->integer(255),

            'dtCriacao'              => $this->datetime(),
            'dtAtualizacao'          => $this->datetime()
        ]);
        $this->addForeignKey('user_protetor_fk', 'user', 'nProtetorID', 'protetor', 'nProtetorID');
        $this->addForeignKey('user_adotante_fk', 'user', 'nAdotanteID', 'adotante', 'nAdotanteID');
        $this->addForeignKey('user_endereco_fk', 'user', 'nEnderecoID', 'endereco', 'nEnderecoID');
    }

    public function safeDown(){
        $this->dropTable('user');
    }
}
