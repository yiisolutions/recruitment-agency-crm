<?php

use app\components\db\Migration;

/**
 * Class m171214_083027_alter_applicant_timestamp_fields
 */
class m171214_083027_alter_applicant_timestamp_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%applicant}}', 'created_at');
        $this->addColumn('{{%applicant}}', 'created_at', $this->timestamp()->defaultExpression('NOW()'));

        $this->dropColumn('{{%applicant}}', 'updated_at');
        $this->addColumn('{{%applicant}}', 'updated_at', $this->timestamp()->defaultExpression('NOW()'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%applicant}}', 'updated_at');
        $this->addColumn('{{%applicant}}', 'updated_at', $this->integer()->notNull());

        $this->dropColumn('{{%applicant}}', 'created_at');
        $this->addColumn('{{%applicant}}', 'created_at', $this->integer()->notNull());
    }
}
