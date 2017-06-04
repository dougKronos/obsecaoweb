<?php

use yii\db\Migration;
use yii\db\Query;
use yii\db\Expression;

class m170603_132130_insert_first_admin extends Migration{
    
    /*public function up(){

    }

    public function down() {
		echo "m170602_002634_cidade_tb_create cannot be reverted.\n";
		return false;
    }*/

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
		$estado = (new Query())
		->select(['nEstadoID'])
		->from('estado')
		->where('strUF = :strUF', [':strUF' => 'RS'])->one();

		$nEstadoID = $estado['nEstadoID'];

		$cidade = (new Query())
		->select(['nCidadeID'])
		->from('cidade')
		->where('nEstadoID = :nEstadoID', [':nEstadoID' => $nEstadoID])->one();

		$nCidadeID = $cidade['nCidadeID'];

		\Yii::$app->db
			->createCommand()
			->insert('endereco', [
				'strLogradouro' => 'Rua Cristovao Colombo',
				'nNumero' => 304,
				'strBairro' => 'Piratini',
				'nCidadeID' => $nCidadeID,
				'dtCriacao' => new Expression('NOW()'),
				'dtAtualizacao' => new Expression('NOW()')
			])->execute();

		$endereco = (new Query())
		->select(['nEnderecoID'])
		->from('endereco')
		->where([
			'nNumero'       => 304,
			'strLogradouro' => 'Rua Cristovao Colombo'
		])->one();

		$nEnderecoID = $endereco['nEnderecoID'];

		\Yii::$app->db
			->createCommand()
			->insert('user', [
				'strNome' => 'Douglas Leandro',
				'email' => 'douglas.gtads@gmail.com',
				'strSenha' => password_hash('admin', PASSWORD_DEFAULT),
				'strTelefone' => '(51) 99289 9238',
				'nEnderecoID' => $nEnderecoID,
				'dtCriacao' => new Expression('NOW()'),
				'dtAtualizacao' => new Expression('NOW()')
			])->execute();
    }

    public function safeDown(){
     	\Yii::$app->db->createCommand("DELETE FROM user WHERE email='douglas.gtads@gmail.com'")->execute();
     	\Yii::$app->db->createCommand("DELETE FROM endereco WHERE nNumero='304' AND strLogradouro='Rua Cristovao Colombo'")->execute();
    }
}
