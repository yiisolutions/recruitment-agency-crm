<?php

use app\components\db\Migration;

/**
 * Handles adding language to table `{{%user}}`.
 */
class m171210_083225_add_language_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'language', $this->string()->defaultValue(null));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'language');
    }
}
