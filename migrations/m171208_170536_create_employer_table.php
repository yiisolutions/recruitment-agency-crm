<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m171208_170536_create_employer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%employer}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'site_url' => $this->string()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-employer-title}}', '{{%employer}}', 'title');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-employer-title}}', '{{%employer}}');
        $this->dropTable('{{%employer}}');
    }
}
