<?php

use yii\db\Schema;
use yii\db\Migration;

class m170522_014152_init extends Migration
{
    /*public function up()
    {

    }

    public function down()
    {
        echo "m170522_014152_init cannot be reverted.\n";

        return false;
    }*/

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp(){
        $temp = $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            // $this->primaryKey()
            'email' => Schema::TYPE_STRING,
            // $this->string(255) // String with 255 characters
            'password'   => Schema::TYPE_STRING,
            'name'       => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            // $this->integer()
            'updated_at' => Schema::TYPE_INTEGER
        ]);

        $this->insert('user', [
            'id'         => 1,
            'email'      => 'test2@example.com',
            'password'   => 'test1',
            'name' => 'test user'
        ]);
        $this->insert('user', [
            'id'         => 2,
            'email'      => 'test@example.com',
            'password'   => 'test2',
            'name' => 'test user 2'
        ]);
        return $temp;
    }

    public function safeDown(){
        return $this->dropTable('user');
    }
}
