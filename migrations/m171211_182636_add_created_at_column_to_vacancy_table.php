<?php

use app\components\db\Migration;

/**
 * Handles adding created_at to table `{{%vacancy}}`.
 */
class m171211_182636_add_created_at_column_to_vacancy_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%vacancy}}', 'created_at', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vacancy}}', 'created_at');
    }
}
