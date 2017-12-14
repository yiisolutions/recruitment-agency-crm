<?php

use app\components\db\Migration;

/**
 * Class m171214_182205_alter_location_timestamp_fields
 */
class m171214_182205_alter_location_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%location}}', 'created_at');
        $this->addColumn('{{%location}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%location}}', 'updated_at');
        $this->addColumn('{{%location}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%location}}', 'updated_at');
        $this->addColumn('{{%location}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%location}}', 'created_at');
        $this->addColumn('{{%location}}', 'created_at', $this->integer()->notNull());
    }
}
