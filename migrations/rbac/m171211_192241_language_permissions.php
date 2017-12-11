<?php

use app\components\rbac\Migration;

/**
 * Class m171211_192241_language_permissions
 */
class m171211_192241_language_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $languageReadPerm = $am->createPermission('language_read');
        $languageCreatePerm = $am->createPermission('language_create');
        $languageUpdatePerm = $am->createPermission('language_update');
        $languageDeletePerm = $am->createPermission('language_delete');

        $am->add($languageReadPerm);
        $am->add($languageCreatePerm);
        $am->add($languageUpdatePerm);
        $am->add($languageDeletePerm);

        $am->addChild($managerRole, $languageReadPerm);
        $am->addChild($managerRole, $languageCreatePerm);
        $am->addChild($managerRole, $languageUpdatePerm);
        $am->addChild($managerRole, $languageDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $languageReadPerm = $am->getPermission('language_read');
        $languageCreatePerm = $am->getPermission('language_create');
        $languageUpdatePerm = $am->getPermission('language_update');
        $languageDeletePerm = $am->getPermission('language_delete');

        $am->removeChild($managerRole, $languageReadPerm);
        $am->removeChild($managerRole, $languageCreatePerm);
        $am->removeChild($managerRole, $languageUpdatePerm);
        $am->removeChild($managerRole, $languageDeletePerm);

        $am->remove($languageDeletePerm);
        $am->remove($languageUpdatePerm);
        $am->remove($languageCreatePerm);
        $am->remove($languageReadPerm);
    }
}
