<?php

use app\components\db\Migration;

/**
 * Class m171214_182245_alter_scope_timestamp_fields
 */
class m171214_182245_alter_scope_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%scope}}', 'created_at');
        $this->addColumn('{{%scope}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%scope}}', 'updated_at');
        $this->addColumn('{{%scope}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%scope}}', 'updated_at');
        $this->addColumn('{{%scope}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%scope}}', 'created_at');
        $this->addColumn('{{%scope}}', 'created_at', $this->integer()->notNull());
    }
}
