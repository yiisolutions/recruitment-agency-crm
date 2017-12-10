<?php

use app\components\rbac\Migration;

/**
 * Class m171210_104759_scope_permissions
 */
class m171210_104759_scope_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $scopeReadPerm = $am->createPermission('scope_read');
        $scopeCreatePerm = $am->createPermission('scope_create');
        $scopeUpdatePerm = $am->createPermission('scope_update');
        $scopeDeletePerm = $am->createPermission('scope_delete');

        $am->add($scopeReadPerm);
        $am->add($scopeCreatePerm);
        $am->add($scopeUpdatePerm);
        $am->add($scopeDeletePerm);

        $am->addChild($managerRole, $scopeReadPerm);
        $am->addChild($managerRole, $scopeCreatePerm);
        $am->addChild($managerRole, $scopeUpdatePerm);
        $am->addChild($managerRole, $scopeDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $scopeReadPerm = $am->getPermission('scope_read');
        $scopeCreatePerm = $am->getPermission('scope_create');
        $scopeUpdatePerm = $am->getPermission('scope_update');
        $scopeDeletePerm = $am->getPermission('scope_delete');

        $am->removeChild($managerRole, $scopeReadPerm);
        $am->removeChild($managerRole, $scopeCreatePerm);
        $am->removeChild($managerRole, $scopeUpdatePerm);
        $am->removeChild($managerRole, $scopeDeletePerm);

        $am->remove($scopeDeletePerm);
        $am->remove($scopeUpdatePerm);
        $am->remove($scopeCreatePerm);
        $am->remove($scopeReadPerm);
    }
}
