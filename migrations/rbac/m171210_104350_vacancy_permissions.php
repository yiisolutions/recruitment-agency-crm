<?php

use app\components\rbac\Migration;

/**
 * Class m171210_104350_vacancy_permissions
 */
class m171210_104350_vacancy_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $vacancyReadPerm = $am->createPermission('vacancy_read');
        $vacancyCreatePerm = $am->createPermission('vacancy_create');
        $vacancyUpdatePerm = $am->createPermission('vacancy_update');
        $vacancyDeletePerm = $am->createPermission('vacancy_delete');

        $am->add($vacancyReadPerm);
        $am->add($vacancyCreatePerm);
        $am->add($vacancyUpdatePerm);
        $am->add($vacancyDeletePerm);

        $am->addChild($managerRole, $vacancyReadPerm);
        $am->addChild($managerRole, $vacancyCreatePerm);
        $am->addChild($managerRole, $vacancyUpdatePerm);
        $am->addChild($managerRole, $vacancyDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $vacancyReadPerm = $am->getPermission('vacancy_read');
        $vacancyCreatePerm = $am->getPermission('vacancy_create');
        $vacancyUpdatePerm = $am->getPermission('vacancy_update');
        $vacancyDeletePerm = $am->getPermission('vacancy_delete');

        $am->removeChild($managerRole, $vacancyReadPerm);
        $am->removeChild($managerRole, $vacancyCreatePerm);
        $am->removeChild($managerRole, $vacancyUpdatePerm);
        $am->removeChild($managerRole, $vacancyDeletePerm);

        $am->remove($vacancyDeletePerm);
        $am->remove($vacancyUpdatePerm);
        $am->remove($vacancyCreatePerm);
        $am->remove($vacancyReadPerm);
    }
}
