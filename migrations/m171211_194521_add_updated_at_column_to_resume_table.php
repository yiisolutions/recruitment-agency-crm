<?php

use app\components\db\Migration;

/**
 * Handles adding updated_at to table `{{%resume}}`.
 */
class m171211_194521_add_updated_at_column_to_resume_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%resume}}', 'updated_at', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%resume}}', 'updated_at');
    }
}
