<?php

use app\components\db\Migration;

/**
 * Class m171214_182225_alter_resume_timestamp_fields
 */
class m171214_182225_alter_resume_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%resume}}', 'created_at');
        $this->addColumn('{{%resume}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%resume}}', 'updated_at');
        $this->addColumn('{{%resume}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%resume}}', 'updated_at');
        $this->addColumn('{{%resume}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%resume}}', 'created_at');
        $this->addColumn('{{%resume}}', 'created_at', $this->integer()->notNull());
    }
}
