<?php

use app\components\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-user-name}}',
            '{{%user}}',
            ['first_name', 'last_name']
        );

        $this->createIndex(
            '{{%idx-user-username}}',
            '{{%user}}',
            'username',
            true
        );

        $this->createIndex(
            '{{%idx-user-email}}',
            '{{%user}}',
            'email',
            true
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-user-email}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-username}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-name}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
