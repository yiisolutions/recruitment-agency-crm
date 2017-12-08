<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `applicant`.
 */
class m171209_173451_create_applicant_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%applicant}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'phone' => $this->string(32)->defaultValue(null),
            'email' => $this->string()->defaultValue(null),
            'age' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-applicant-name}}',
            '{{%applicant}}',
            ['first_name', 'last_name']
        );

        $this->createIndex(
            '{{%idx-applicant-phone}}',
            '{{%applicant}}',
            'phone'
        );

        $this->createIndex(
            '{{%idx-applicant-email}}',
            '{{%applicant}}',
            'email'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-applicant-email}}',
            '{{%applicant}}'
        );

        $this->dropIndex(
            '{{%idx-applicant-phone}}',
            '{{%applicant}}'
        );

        $this->dropIndex(
            '{{%idx-applicant-name}}',
            '{{%applicant}}'
        );

        $this->dropTable('{{%applicant}}');
    }
}
