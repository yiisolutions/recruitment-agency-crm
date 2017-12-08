<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%vacancy_skill}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%vacancy}}`
 * - `{{%skill}}`
 */
class m171209_185334_create_junction_table_for_vacancy_and_skill_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy_skill}}', [
            'vacancy_id' => $this->integer(),
            'skill_id' => $this->integer(),
            'PRIMARY KEY(vacancy_id, skill_id)',
        ]);

        // creates index for column `vacancy_id`
        $this->createIndex(
            '{{%idx-vacancy_skill-vacancy_id}}',
            '{{%vacancy_skill}}',
            'vacancy_id'
        );

        // add foreign key for table `{{%vacancy}}`
        $this->addForeignKey(
            '{{%fk-vacancy_skill-vacancy_id}}',
            '{{%vacancy_skill}}',
            'vacancy_id',
            '{{%vacancy}}',
            'id',
            'CASCADE'
        );

        // creates index for column `skill_id`
        $this->createIndex(
            '{{%idx-vacancy_skill-skill_id}}',
            '{{%vacancy_skill}}',
            'skill_id'
        );

        // add foreign key for table `{{%skill}}`
        $this->addForeignKey(
            '{{%fk-vacancy_skill-skill_id}}',
            '{{%vacancy_skill}}',
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
        // drops foreign key for table `{{%vacancy}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_skill-vacancy_id}}',
            '{{%vacancy_skill}}'
        );

        // drops index for column `vacancy_id`
        $this->dropIndex(
            '{{%idx-vacancy_skill-vacancy_id}}',
            '{{%vacancy_skill}}'
        );

        // drops foreign key for table `{{%skill}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_skill-skill_id}}',
            '{{%vacancy_skill}}'
        );

        // drops index for column `skill_id`
        $this->dropIndex(
            '{{%idx-vacancy_skill-skill_id}}',
            '{{%vacancy_skill}}'
        );

        $this->dropTable('{{%vacancy_skill}}');
    }
}
