<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%resume_scope}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%resume}}`
 * - `{{%scope}}`
 */
class m171209_183408_create_junction_table_for_resume_and_scope_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_scope}}', [
            'resume_id' => $this->integer(),
            'scope_id' => $this->integer(),
            'PRIMARY KEY(resume_id, scope_id)',
        ]);

        // creates index for column `resume_id`
        $this->createIndex(
            '{{%idx-resume_scope-resume_id}}',
            '{{%resume_scope}}',
            'resume_id'
        );

        // add foreign key for table `{{%resume}}`
        $this->addForeignKey(
            '{{%fk-resume_scope-resume_id}}',
            '{{%resume_scope}}',
            'resume_id',
            '{{%resume}}',
            'id',
            'CASCADE'
        );

        // creates index for column `scope_id`
        $this->createIndex(
            '{{%idx-resume_scope-scope_id}}',
            '{{%resume_scope}}',
            'scope_id'
        );

        // add foreign key for table `{{%scope}}`
        $this->addForeignKey(
            '{{%fk-resume_scope-scope_id}}',
            '{{%resume_scope}}',
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
        // drops foreign key for table `{{%resume}}`
        $this->dropForeignKey(
            '{{%fk-resume_scope-scope_id}}',
            '{{%resume_scope}}'
        );

        // drops index for column `resume_id`
        $this->dropIndex(
            '{{%idx-resume_scope-scope_id}}',
            '{{%resume_scope}}'
        );

        // drops foreign key for table `{{%scope}}`
        $this->dropForeignKey(
            '{{%fk-resume_scope-resume_id}}',
            '{{%resume_scope}}'
        );

        // drops index for column `scope_id`
        $this->dropIndex(
            '{{%idx-resume_scope-resume_id}}',
            '{{%resume_scope}}'
        );

        $this->dropTable('{{%resume_scope}}');
    }
}
