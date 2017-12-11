<?php

use app\components\db\Migration;

/**
 * Handles adding updated_at to table `{{%vacancy}}`.
 */
class m171211_182651_add_updated_at_column_to_vacancy_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%vacancy}}', 'updated_at', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vacancy}}', 'updated_at');
    }
}
