<?php

use app\components\rbac\Migration;

/**
 * Class m171210_105012_skill_permissions
 */
class m171210_105012_skill_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $skillReadPerm = $am->createPermission('skill_read');
        $skillCreatePerm = $am->createPermission('skill_create');
        $skillUpdatePerm = $am->createPermission('skill_update');
        $skillDeletePerm = $am->createPermission('skill_delete');

        $am->add($skillReadPerm);
        $am->add($skillCreatePerm);
        $am->add($skillUpdatePerm);
        $am->add($skillDeletePerm);

        $am->addChild($managerRole, $skillReadPerm);
        $am->addChild($managerRole, $skillCreatePerm);
        $am->addChild($managerRole, $skillUpdatePerm);
        $am->addChild($managerRole, $skillDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $skillReadPerm = $am->getPermission('skill_read');
        $skillCreatePerm = $am->getPermission('skill_create');
        $skillUpdatePerm = $am->getPermission('skill_update');
        $skillDeletePerm = $am->getPermission('skill_delete');

        $am->removeChild($managerRole, $skillReadPerm);
        $am->removeChild($managerRole, $skillCreatePerm);
        $am->removeChild($managerRole, $skillUpdatePerm);
        $am->removeChild($managerRole, $skillDeletePerm);

        $am->remove($skillDeletePerm);
        $am->remove($skillUpdatePerm);
        $am->remove($skillCreatePerm);
        $am->remove($skillReadPerm);
    }
}
