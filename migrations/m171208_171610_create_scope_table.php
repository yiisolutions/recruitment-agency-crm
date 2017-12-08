<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `scope`.
 * Has foreign keys to the tables:
 *
 * - `scope`
 */
class m171208_171610_create_scope_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%scope}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'parent_id' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-scope-parent_id}}',
            '{{%scope}}',
            'parent_id'
        );

        // add foreign key for table `scope`
        $this->addForeignKey(
            '{{%fk-scope-parent_id}}',
            '{{%scope}}',
            'parent_id',
            'scope',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `scope`
        $this->dropForeignKey(
            '{{%fk-scope-parent_id}}',
            '{{%scope}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-scope-parent_id}}',
            '{{%scope}}'
        );

        $this->dropTable('{{%scope}}');
    }
}
