<?php

use app\components\db\Migration;

/**
 * Class m171214_090341_alter_user_timestamp_fields
 */
class m171214_090341_alter_user_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'created_at');
        $this->addColumn('{{%user}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%user}}', 'updated_at');
        $this->addColumn('{{%user}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'updated_at');
        $this->addColumn('{{%user}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%user}}', 'created_at');
        $this->addColumn('{{%user}}', 'created_at', $this->integer()->notNull());
    }
}
