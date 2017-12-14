<?php

use app\components\db\Migration;

/**
 * Class m171214_093220_alter_language_timestamp_fields
 */
class m171214_093220_alter_language_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%language}}', 'created_at');
        $this->addColumn('{{%language}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%language}}', 'updated_at');
        $this->addColumn('{{%language}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%language}}', 'updated_at');
        $this->addColumn('{{%language}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%language}}', 'created_at');
        $this->addColumn('{{%language}}', 'created_at', $this->integer()->notNull());
    }
}
