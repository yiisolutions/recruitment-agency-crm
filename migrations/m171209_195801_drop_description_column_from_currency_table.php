<?php

use app\components\db\Migration;

/**
 * Handles dropping description from table `{{%currency}}`.
 */
class m171209_195801_drop_description_column_from_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%currency}}', 'description');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn('{{%currency}}', 'description', $this->text()->defaultValue(null));
    }
}
