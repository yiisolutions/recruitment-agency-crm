<?php

use app\components\rbac\Migration;

/**
 * Class m171210_102432_employer_permissions
 */
class m171210_102432_employer_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $employerReadPerm = $am->createPermission('employer_read');
        $employerCreatePerm = $am->createPermission('employer_create');
        $employerUpdatePerm = $am->createPermission('employer_update');
        $employerDeletePerm = $am->createPermission('employer_delete');

        $am->add($employerReadPerm);
        $am->add($employerCreatePerm);
        $am->add($employerUpdatePerm);
        $am->add($employerDeletePerm);

        $am->addChild($managerRole, $employerReadPerm);
        $am->addChild($managerRole, $employerCreatePerm);
        $am->addChild($managerRole, $employerUpdatePerm);
        $am->addChild($managerRole, $employerDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $employerReadPerm = $am->getPermission('employer_read');
        $employerCreatePerm = $am->getPermission('employer_create');
        $employerUpdatePerm = $am->getPermission('employer_update');
        $employerDeletePerm = $am->getPermission('employer_delete');

        $am->removeChild($managerRole, $employerReadPerm);
        $am->removeChild($managerRole, $employerCreatePerm);
        $am->removeChild($managerRole, $employerUpdatePerm);
        $am->removeChild($managerRole, $employerDeletePerm);

        $am->remove($employerDeletePerm);
        $am->remove($employerUpdatePerm);
        $am->remove($employerCreatePerm);
        $am->remove($employerReadPerm);
    }
}
