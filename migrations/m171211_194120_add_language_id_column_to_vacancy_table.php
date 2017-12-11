<?php

use app\components\db\Migration;

/**
 * Handles adding language_id to table `{{%vacancy}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%language}}`
 */
class m171211_194120_add_language_id_column_to_vacancy_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%vacancy}}', 'language_id', $this->integer()->defaultValue(null));

        // creates index for column `language_id`
        $this->createIndex(
            '{{%idx-vacancy-language_id}}',
            '{{%vacancy}}',
            'language_id'
        );

        // add foreign key for table `{{%language}}`
        $this->addForeignKey(
            '{{%fk-vacancy-language_id}}',
            '{{%vacancy}}',
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
            '{{%fk-vacancy-language_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `language_id`
        $this->dropIndex(
            '{{%idx-vacancy-language_id}}',
            '{{%vacancy}}'
        );

        $this->dropColumn('{{%vacancy}}', 'language_id');
    }
}
