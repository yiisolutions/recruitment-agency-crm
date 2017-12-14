<?php

use app\components\rbac\Migration;

/**
 * Class m171214_092255_create_audit_read
 */
class m171214_092255_create_audit_read extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $adminRole = $am->getRole('admin');

        $auditReadPerm = $am->createPermission('audit_read');

        $am->add($auditReadPerm);

        $am->addChild($adminRole, $auditReadPerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $adminRole = $am->getRole('admin');

        $auditReadPerm = $am->createPermission('audit_read');

        $am->removeChild($adminRole, $auditReadPerm);

        $am->remove($auditReadPerm);
    }
}
