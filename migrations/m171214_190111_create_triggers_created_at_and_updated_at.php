<?php

use app\components\db\Migration;

/**
 * Class m171214_190111_create_triggers_created_at_and_updated_at
 */
class m171214_190111_create_triggers_created_at_and_updated_at extends Migration
{
    private $tables = [
        'applicant',
        'currency',
        'employer',
        'language',
        'location',
        'resume',
        'scope',
        'skill',
        'user',
        'vacancy',
    ];

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        foreach ($this->tables as $table) {
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
        }
    }
}
