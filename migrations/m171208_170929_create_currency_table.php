<?php

use app\components\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m171208_170929_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'iso4217' => $this->string(3)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-currency-title}}', '{{%currency}}', 'title');
        $this->createIndex('{{%idx-currency-iso4217}}', '{{%currency}}', 'iso4217', true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-currency-iso4217}}', '{{%currency}}');
        $this->dropIndex('{{%idx-currency-title}}', '{{%currency}}');
        $this->dropTable('{{%currency}}');
    }
}
