<?php

use app\components\db\Migration;

/**
 * Handles adding language_id to table `{{%resume}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%language}}`
 */
class m171211_194156_add_language_id_column_to_resume_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%resume}}', 'language_id', $this->integer()->defaultValue(null));

        // creates index for column `language_id`
        $this->createIndex(
            '{{%idx-resume-language_id}}',
            '{{%resume}}',
            'language_id'
        );

        // add foreign key for table `{{%language}}`
        $this->addForeignKey(
            '{{%fk-resume-language_id}}',
            '{{%resume}}',
            'language_id',
            '{{%language}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%language}}`
        $this->dropForeignKey(
            '{{%fk-resume-language_id}}',
            '{{%resume}}'
        );

        // drops index for column `language_id`
        $this->dropIndex(
            '{{%idx-resume-language_id}}',
            '{{%resume}}'
        );

        $this->dropColumn('{{%resume}}', 'language_id');
    }
}
