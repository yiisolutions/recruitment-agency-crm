<?php

use app\components\db\Migration;

/**
 * Class m171214_182314_alter_vacancy_timestamp_fields
 */
class m171214_182314_alter_vacancy_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%vacancy}}', 'created_at');
        $this->addColumn('{{%vacancy}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%vacancy}}', 'updated_at');
        $this->addColumn('{{%vacancy}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vacancy}}', 'updated_at');
        $this->addColumn('{{%vacancy}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%vacancy}}', 'created_at');
        $this->addColumn('{{%vacancy}}', 'created_at', $this->integer()->notNull());
    }
}
