<?php

use yii\db\Migration;
use yii\db\Schema;

class m170523_003729_name_change extends Migration
{
  /*  public function up()
	{

	}

	public function down()
	{
		echo "m170523_003729_name_change cannot be reverted.\n";

		return false;
	}
*/
	
	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp(){
		$users = \Yii::$app->db
				->createCommand('SELECT * FROM user')
				->queryAll();

		$this->dropTable('user');
		$this->createTable('user', [
			'id'     => Schema::TYPE_PK,
			'email'  => Schema::TYPE_STRING . ' NOT NULL',
			'password' => Schema::TYPE_STRING . ' NOT NULL',
			'first_name' => Schema::TYPE_STRING,
			'last_name' => Schema::TYPE_STRING,
			'created_at' => Schema::TYPE_INTEGER,
			'updated_at' => Schema::TYPE_INTEGER
		]);

		$this->createIndex('user_unique_email', 'user', 'email', true);

		foreach ($users as $user) {
			$this->insert('user', [
				'id'         => $user['id'],
				'email'      => $user['email'],
				'password'   => $user['password'],
				'first_name' => $user['name'],
				'created_at'  => $user['created_at'],
				'updated_at'	 => $user['updated_at']
			]);
		}
	}

    public function safeDown(){
    	$this->dropTable('user');
	}
	
}
