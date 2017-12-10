<?php

use app\components\rbac\Migration;

/**
 * Class m171210_104512_location_permissions
 */
class m171210_104512_location_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $locationReadPerm = $am->createPermission('location_read');
        $locationCreatePerm = $am->createPermission('location_create');
        $locationUpdatePerm = $am->createPermission('location_update');
        $locationDeletePerm = $am->createPermission('location_delete');

        $am->add($locationReadPerm);
        $am->add($locationCreatePerm);
        $am->add($locationUpdatePerm);
        $am->add($locationDeletePerm);

        $am->addChild($managerRole, $locationReadPerm);
        $am->addChild($managerRole, $locationCreatePerm);
        $am->addChild($managerRole, $locationUpdatePerm);
        $am->addChild($managerRole, $locationDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $locationReadPerm = $am->getPermission('location_read');
        $locationCreatePerm = $am->getPermission('location_create');
        $locationUpdatePerm = $am->getPermission('location_update');
        $locationDeletePerm = $am->getPermission('location_delete');

        $am->removeChild($managerRole, $locationReadPerm);
        $am->removeChild($managerRole, $locationCreatePerm);
        $am->removeChild($managerRole, $locationUpdatePerm);
        $am->removeChild($managerRole, $locationDeletePerm);

        $am->remove($locationDeletePerm);
        $am->remove($locationUpdatePerm);
        $am->remove($locationCreatePerm);
        $am->remove($locationReadPerm);
    }
}
