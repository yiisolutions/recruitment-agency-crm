<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `location`.
 * Has foreign keys to the tables:
 *
 * - `location`
 */
class m171208_172423_create_location_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'level' => $this->integer()->defaultValue(0),
            'parent_id' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-location-parent_id}}',
            '{{%location}}',
            'parent_id'
        );

        // add foreign key for table `location`
        $this->addForeignKey(
            '{{%fk-location-parent_id}}',
            '{{%location}}',
            'parent_id',
            'location',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `location`
        $this->dropForeignKey(
            '{{%fk-location-parent_id}}',
            '{{%location}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-location-parent_id}}',
            '{{%location}}'
        );

        $this->dropTable('{{%location}}');
    }
}
