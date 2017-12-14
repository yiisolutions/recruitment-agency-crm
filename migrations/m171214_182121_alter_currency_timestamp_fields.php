<?php

use app\components\db\Migration;

/**
 * Class m171214_182121_alter_currency_timestamp_fields
 */
class m171214_182121_alter_currency_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%currency}}', 'created_at');
        $this->addColumn('{{%currency}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%currency}}', 'updated_at');
        $this->addColumn('{{%currency}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%currency}}', 'updated_at');
        $this->addColumn('{{%currency}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%currency}}', 'created_at');
        $this->addColumn('{{%currency}}', 'created_at', $this->integer()->notNull());
    }
}
