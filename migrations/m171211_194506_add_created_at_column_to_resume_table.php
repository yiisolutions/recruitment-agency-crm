<?php

use app\components\db\Migration;

/**
 * Handles adding created_at to table `{{%resume}}`.
 */
class m171211_194506_add_created_at_column_to_resume_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%resume}}', 'created_at', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%resume}}', 'created_at');
    }
}
