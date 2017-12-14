<?php

use app\components\db\Migration;

/**
 * Class m171214_191609_add_timestamp_columns_for_junction_tables
 */
class m171214_191609_add_timestamp_columns_for_junction_tables extends Migration
{
    private $tables = [
        'resume_scope',
        'resume_skill',
        'vacancy_scope',
        'vacancy_skill',
    ];

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        foreach ($this->tables as $table) {
            $this->addColumn('{{%' . $table . '}}', 'created_at', $this->timestamp()->defaultExpression('now()'));
            $this->addColumn('{{%' . $table . '}}', 'updated_at', $this->timestamp()->defaultExpression('now()'));

            $sql = "CREATE TRIGGER {$table}__before_insert\n" .
                "BEFORE INSERT ON {$table}\n" .
                "FOR EACH ROW SET NEW.created_at = NOW();";
            $this->execute($sql);

            $sql = "CREATE TRIGGER {$table}__before_update\n" .
                "BEFORE UPDATE ON {$table}\n" .
                "FOR EACH ROW SET NEW.created_at = OLD.created_at, NEW.updated_at = NOW();";
            $this->execute($sql);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        foreach ($this->tables as $table) {
            $this->execute("DROP TRIGGER IF EXISTS {$table}__before_insert;");
            $this->execute("DROP TRIGGER IF EXISTS {$table}__before_update;");

            $this->dropColumn('{{%' . $table . '}}', 'updated_at');
            $this->dropColumn('{{%' . $table . '}}', 'created_at');
        }
    }
}
