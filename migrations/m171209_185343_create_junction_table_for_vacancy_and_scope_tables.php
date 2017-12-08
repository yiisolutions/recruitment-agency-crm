<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%vacancy_scope}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%vacancy}}`
 * - `{{%scope}}`
 */
class m171209_185343_create_junction_table_for_vacancy_and_scope_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy_scope}}', [
            'vacancy_id' => $this->integer(),
            'scope_id' => $this->integer(),
            'PRIMARY KEY(vacancy_id, scope_id)',
        ]);

        // creates index for column `vacancy_id`
        $this->createIndex(
            '{{%idx-vacancy_scope-vacancy_id}}',
            '{{%vacancy_scope}}',
            'vacancy_id'
        );

        // add foreign key for table `{{%vacancy}}`
        $this->addForeignKey(
            '{{%fk-vacancy_scope-vacancy_id}}',
            '{{%vacancy_scope}}',
            'vacancy_id',
            '{{%vacancy}}',
            'id',
            'CASCADE'
        );

        // creates index for column `scope_id`
        $this->createIndex(
            '{{%idx-vacancy_scope-scope_id}}',
            '{{%vacancy_scope}}',
            'scope_id'
        );

        // add foreign key for table `{{%scope}}`
        $this->addForeignKey(
            '{{%fk-vacancy_scope-scope_id}}',
            '{{%vacancy_scope}}',
            'scope_id',
            '{{%scope}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%vacancy}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_scope-vacancy_id}}',
            '{{%vacancy_scope}}'
        );

        // drops index for column `vacancy_id`
        $this->dropIndex(
            '{{%idx-vacancy_scope-vacancy_id}}',
            '{{%vacancy_scope}}'
        );

        // drops foreign key for table `{{%scope}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_scope-scope_id}}',
            '{{%vacancy_scope}}'
        );

        // drops index for column `scope_id`
        $this->dropIndex(
            '{{%idx-vacancy_scope-scope_id}}',
            '{{%vacancy_scope}}'
        );

        $this->dropTable('{{%vacancy_scope}}');
    }
}
