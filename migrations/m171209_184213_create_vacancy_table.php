<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%vacancy}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%employer}}`
 * - `{{%currency}}`
 * - `{{%location}}`
 */
class m171209_184213_create_vacancy_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'employer_id' => $this->integer()->notNull(),
            'salary_from' => $this->decimal(12,2)->defaultValue(null),
            'salary_to' => $this->decimal(12,2)->defaultValue(null),
            'salary_amount' => $this->decimal(12,2)->defaultValue(null),
            'salary_currency_id' => $this->integer()->defaultValue(null),
            'location_id' => $this->integer()->defaultValue(null),
        ]);

        // creates index for column `employer_id`
        $this->createIndex(
            '{{%idx-vacancy-employer_id}}',
            '{{%vacancy}}',
            'employer_id'
        );

        // add foreign key for table `{{%employer}}`
        $this->addForeignKey(
            '{{%fk-vacancy-employer_id}}',
            '{{%vacancy}}',
            'employer_id',
            '{{%employer}}',
            'id',
            'CASCADE'
        );

        // creates index for column `salary_currency_id`
        $this->createIndex(
            '{{%idx-vacancy-salary_currency_id}}',
            '{{%vacancy}}',
            'salary_currency_id'
        );

        // add foreign key for table `{{%currency}}`
        $this->addForeignKey(
            '{{%fk-vacancy-salary-currency_id}}',
            '{{%vacancy}}',
            'salary_currency_id',
            '{{%currency}}',
            'id',
            'CASCADE'
        );

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-vacancy-location_id}}',
            '{{%vacancy}}',
            'location_id'
        );

        // add foreign key for table `{{%location}}`
        $this->addForeignKey(
            '{{%fk-vacancy-location_id}}',
            '{{%vacancy}}',
            'location_id',
            '{{%location}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%employer}}`
        $this->dropForeignKey(
            '{{%fk-vacancy-employer_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `employer_id`
        $this->dropIndex(
            '{{%idx-vacancy-employer_id}}',
            '{{%vacancy}}'
        );

        // drops foreign key for table `{{%currency}}`
        $this->dropForeignKey(
            '{{%fk-vacancy-salary-currency_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `salary_currency_id`
        $this->dropIndex(
            '{{%idx-vacancy-salary_currency_id}}',
            '{{%vacancy}}'
        );

        // drops foreign key for table `{{%location}}`
        $this->dropForeignKey(
            '{{%fk-vacancy-location_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-vacancy-location_id}}',
            '{{%vacancy}}'
        );

        $this->dropTable('{{%vacancy}}');
    }
}
