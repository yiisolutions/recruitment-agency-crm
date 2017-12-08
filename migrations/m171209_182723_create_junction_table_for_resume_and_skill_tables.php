<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%resume_skill}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%resume}}`
 * - `{{%skill}}`
 */
class m171209_182723_create_junction_table_for_resume_and_skill_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_skill}}', [
            'resume_id' => $this->integer(),
            'skill_id' => $this->integer(),
            'PRIMARY KEY(resume_id, skill_id)',
        ]);

        // creates index for column `resume_id`
        $this->createIndex(
            '{{%idx-resume_skill-resume_id}}',
            '{{%resume_skill}}',
            'resume_id'
        );

        // add foreign key for table `{{%resume}}`
        $this->addForeignKey(
            '{{%fk-resume_skill-resume_id}}',
            '{{%resume_skill}}',
            'resume_id',
            '{{%resume}}',
            'id',
            'CASCADE'
        );

        // creates index for column `skill_id`
        $this->createIndex(
            '{{%idx-resume_skill-skill_id}}',
            '{{%resume_skill}}',
            'skill_id'
        );

        // add foreign key for table `{{%skill}}`
        $this->addForeignKey(
            '{{%fk-resume_skill-skill_id}}',
            '{{%resume_skill}}',
            'skill_id',
            '{{%skill}}',
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
            '{{%fk-resume_skill-skill_id}}',
            '{{%resume_skill}}'
        );

        // drops index for column `resume_id`
        $this->dropIndex(
            '{{%idx-resume_skill-skill_id}}',
            '{{%resume_skill}}'
        );

        // drops foreign key for table `{{%skill}}`
        $this->dropForeignKey(
            '{{%fk-resume_skill-resume_id}}',
            '{{%resume_skill}}'
        );

        // drops index for column `skill_id`
        $this->dropIndex(
            '{{%idx-resume_skill-resume_id}}',
            '{{%resume_skill}}'
        );

        $this->dropTable('{{%resume_skill}}');
    }
}
