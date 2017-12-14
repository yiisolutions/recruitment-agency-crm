<?php

use app\components\db\Migration;

/**
 * Class m171214_182258_alter_skill_timestamp_fields
 */
class m171214_182258_alter_skill_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%skill}}', 'created_at');
        $this->addColumn('{{%skill}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%skill}}', 'updated_at');
        $this->addColumn('{{%skill}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%skill}}', 'updated_at');
        $this->addColumn('{{%skill}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%skill}}', 'created_at');
        $this->addColumn('{{%skill}}', 'created_at', $this->integer()->notNull());
    }
}
