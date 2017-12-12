<?php

use app\components\db\Migration;

/**
 * Class m171212_115316_alter_employer_timestamp_fields
 */
class m171212_115316_alter_employer_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%employer}}', 'created_at');
        $this->addColumn('{{%employer}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%employer}}', 'updated_at');
        $this->addColumn('{{%employer}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employer}}', 'updated_at');
        $this->addColumn('{{%employer}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%employer}}', 'created_at');
        $this->addColumn('{{%employer}}', 'created_at', $this->integer()->notNull());
    }
}
