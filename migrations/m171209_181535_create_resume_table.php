<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `{{%resume}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%currency}}`
 * - `{{%location}}`
 */
class m171209_181535_create_resume_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'salary_from' => $this->decimal(12,2)->defaultValue(null),
            'salary_to' => $this->decimal(12,2)->defaultValue(null),
            'salary_amount' => $this->decimal(12,2)->defaultValue(null),
            'salary_currency_id' => $this->integer()->defaultValue(null),
            'location_id' => $this->integer()->defaultValue(null),
            'applicant_id' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-resume-title}}',
            '{{%resume}}',
            'title'
        );

        $this->createIndex(
            '{{%idx-resume-salary_from}}',
            '{{%resume}}',
            'salary_from'
        );

        $this->createIndex(
            '{{%idx-resume-salary_to}}',
            '{{%resume}}',
            'salary_to'
        );

        $this->createIndex(
            '{{%idx-resume-salary_amount}}',
            '{{%resume}}',
            'salary_amount'
        );

        // creates index for column `salary_currency_id`
        $this->createIndex(
            '{{%idx-resume-salary_currency_id}}',
            '{{%resume}}',
            'salary_currency_id'
        );

        // add foreign key for table `{{%currency}}`
        $this->addForeignKey(
            '{{%fk-resume-salary_currency_id}}',
            '{{%resume}}',
            'salary_currency_id',
            '{{%currency}}',
            'id',
            'CASCADE'
        );

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-resume-location_id}}',
            '{{%resume}}',
            'location_id'
        );

        // add foreign key for table `{{%location}}`
        $this->addForeignKey(
            '{{%fk-resume-location_id}}',
            '{{%resume}}',
            'location_id',
            '{{%location}}',
            'id',
            'CASCADE'
        );

        // creates index for column `applicant_id`
        $this->createIndex(
            '{{%idx-resume-applicant_id}}',
            '{{%resume}}',
            'applicant_id'
        );

        // add foreign key for table `{{%applicant}}`
        $this->addForeignKey(
            '{{%fk-resume-applicant_id}}',
            '{{%resume}}',
            'applicant_id',
            '{{%applicant}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%applicant}}`
        $this->dropForeignKey(
            '{{%fk-resume-applicant_id}}',
            '{{%resume}}'
        );

        // drops index for column `applicant_id`
        $this->dropIndex(
            '{{%idx-resume-applicant_id}}',
            '{{%resume}}'
        );

        // drops foreign key for table `{{%location}}`
        $this->dropForeignKey(
            '{{%fk-resume-location_id}}',
            '{{%resume}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-resume-location_id}}',
            '{{%resume}}'
        );

        // drops foreign key for table `{{%currency}}`
        $this->dropForeignKey(
            '{{%fk-resume-salary_currency_id}}',
            '{{%resume}}'
        );

        // drops index for column `salary_currency_id`
        $this->dropIndex(
            '{{%idx-resume-salary_currency_id}}',
            '{{%resume}}'
        );

        $this->dropIndex(
            '{{%idx-resume-salary_amount}}',
            '{{%resume}}'
        );

        $this->dropIndex(
            '{{%idx-resume-salary_to}}',
            '{{%resume}}'
        );

        $this->dropIndex(
            '{{%idx-resume-salary_from}}',
            '{{%resume}}'
        );

        $this->dropIndex(
            '{{%idx-resume-title}}',
            '{{%resume}}'
        );

        $this->dropTable('{{%resume}}');
    }
}
