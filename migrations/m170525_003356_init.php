<?php

use yii\db\Migration;

class m170525_003356_init extends Migration{
	
	private static $arrTablesNames = [
		'usuario',
		'recusa',
		'protetor',
		'permissao',
		'noticia',
		'estado',
		'endereco',
		'depoimento',
		'cidade',
		'cao',
		'anuncio',
		'adotante',
		'administrador'
	];

	/*
		public function up(){

		}

		public function down(){
			echo "m170525_003356_init cannot be reverted.\n";
			return false;
		}
	*/

	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp(){
		// Usuario
		$this->createTable('usuario', [
			'nUsuarioID' => $this->primaryKey(),
			'strNome' => $this->string(255),

			'strEmail' => $this->string(255),
			'strSenha' => $this->binary(20),
			'strEmail' => $this->string(255),
			'strTelefone' => $this->string(15),
			'strTelefoneAlternativo' => $this->string(15),
			'strEmailAternativo' => $this->string(255),
			'foto' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Recusa
		$this->createTable('recusa', [
			'nRecusaID' => $this->primaryKey(),
			'strTitulo' => $this->string(50),
			'strDescricao' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Protetor
		$this->createTable('protetor', [
			'nProtetorID' => $this->primaryKey(),
			'bRealizaEntrega' => $this->integer(1) . ' DEFAULT 0',
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Permissao
		$this->createTable('permissao', [
			'nPermissaoID' => $this->primaryKey(),
			'strDescricao' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Noticia
		$this->createTable('noticia', [
			'nNoticiaID' => $this->primaryKey(),
			'strTopico' => $this->string(50),
			'strDescricao' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Estado
		$this->createTable('estado', [
			'nEstadoID' => $this->primaryKey(),
			'strNome' => $this->string(50),
			'strSigla' => $this->string(2),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Endereco
		$this->createTable('endereco', [
			'nEnderecoID' => $this->primaryKey(),
			'strEndereco' => $this->string(50),
			'strBairro' => $this->string(50),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Depoimento
		$this->createTable('depoimento', [
			'nDepoimentoID' => $this->primaryKey(),
			'strDepoimento' => $this->string(255),
			'foto' => $this->string(255),
			'video' => $this->string(255),
			'cStatusDescricao' => $this->char(1),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Cidade
		$this->createTable('cidade', [
			'nCidadeID' => $this->primaryKey(),
			'strNome' => $this->string(50),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Cao
		$this->createTable('cao', [
			'nCaoID' => $this->primaryKey(),
			'strNome' => $this->string(50),
			'cSexo' => $this->char(1),
			'strRaca' => $this->string(50),
			'nIdade' => $this->integer(50),
			'strCaracteristicas' => $this->string(255),
			'strCaracteristicasComport' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Anuncio
		$this->createTable('anuncio', [
			'nAnuncioID' => $this->primaryKey(),
			'bStatusAprovado' => $this->integer(1) . ' DEFAULT 0',
			'strTitulo' => $this->string(50),
			'strDescricao' => $this->string(255),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Adotante
		$this->createTable('adotante', [
			'nAdotanteID' => $this->primaryKey(),
			'strDetalhesLocal' => $this->string(255),
			'strTipoResidencia' => $this->string(255),
			'bPossuiCriancas' => $this->integer(1) . ' DEFAULT 0',
			'bPossuiBichos' => $this->integer(1) . ' DEFAULT 0',
			'bAdotouAntes' => $this->integer(1) . ' DEFAULT 0',
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);

		// Administrador
		$this->createTable('administrador', [
			'nAdministradorID' => $this->primaryKey(),
			'strNivelGerencial' => $this->string(50),
			'dtCriacao' => $this->datetime(),
			'dtAtualizacao' => $this->datetime()
		]);
	}

	public function safeDown(){
		for ($i=0; $i < sizeof(m170525_003356_init::$arrTablesNames); $i++) { 
			$this->dropTable(m170525_003356_init::$arrTablesNames[$i]);
		}
	}
}
