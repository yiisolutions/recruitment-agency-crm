<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m171211_191732_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'code' => $this->string(2)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-language-title}}',
            '{{%language}}',
            'title'
        );

        $this->createIndex(
            '{{%idx-language-code}}',
            '{{%language}}',
            'code',
            true
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-language-code}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-title}}',
            '{{%language}}'
        );

        $this->dropTable('{{%language}}');
    }
}
