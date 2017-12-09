<?php

use app\components\db\Migration;

/**
 * Handles dropping description from table `{{%skill}}`.
 */
class m171209_194541_drop_description_column_from_skill_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%skill}}', 'description');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn('{{%skill}}', 'description', $this->text()->defaultValue(null));
    }
}
