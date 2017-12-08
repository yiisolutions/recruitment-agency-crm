<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `skill`.
 */
class m171208_171915_create_skill_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%skill}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-skill-title}}', '{{%skill}}', 'title');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-skill-title}}', '{{%skill}}');
        $this->dropTable('{{%skill}}');
    }
}
