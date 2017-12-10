<?php

use app\components\rbac\Migration;

/**
 * Class m171210_093406_user_permissions
 */
class m171210_093406_user_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $adminRole = $am->getRole('admin');

        $userReadPerm = $am->createPermission('user_read');
        $userCreatePerm = $am->createPermission('user_create');
        $userUpdatePerm = $am->createPermission('user_update');
        $userDeletePerm = $am->createPermission('user_delete');

        $am->add($userReadPerm);
        $am->add($userCreatePerm);
        $am->add($userUpdatePerm);
        $am->add($userDeletePerm);

        $am->addChild($adminRole, $userReadPerm);
        $am->addChild($adminRole, $userCreatePerm);
        $am->addChild($adminRole, $userUpdatePerm);
        $am->addChild($adminRole, $userDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $adminRole = $am->getRole('admin');

        $userReadPerm = $am->getPermission('user_read');
        $userCreatePerm = $am->getPermission('user_create');
        $userUpdatePerm = $am->getPermission('user_update');
        $userDeletePerm = $am->getPermission('user_delete');

        $am->removeChild($adminRole, $userReadPerm);
        $am->removeChild($adminRole, $userCreatePerm);
        $am->removeChild($adminRole, $userUpdatePerm);
        $am->removeChild($adminRole, $userDeletePerm);

        $am->remove($userDeletePerm);
        $am->remove($userUpdatePerm);
        $am->remove($userCreatePerm);
        $am->remove($userReadPerm);
    }
}
