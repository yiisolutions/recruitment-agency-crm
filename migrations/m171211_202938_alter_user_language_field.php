<?php

use app\components\db\Migration;

/**
 * Class m171211_202938_alter_user_language_field
 */
class m171211_202938_alter_user_language_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'language');
        $this->addColumn('{{%user}}', 'language_id', $this->integer()->defaultValue(null));

        $this->createIndex(
            '{{%idx-user-language_id}}',
            '{{%user}}',
            'language_id'
        );

        $this->addForeignKey(
            '{{%fk-user-language_id}}',
            '{{%user}}',
            'language_id',
            '{{%language}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-user-language_id}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-language_id}}',
            '{{%user}}'
        );

        $this->dropColumn('{{%user}}', 'language_id');
        $this->addColumn('{{%user}}', 'language', $this->string(2)->defaultValue(null));
    }
}
