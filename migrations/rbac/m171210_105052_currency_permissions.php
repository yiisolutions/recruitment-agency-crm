<?php

use app\components\rbac\Migration;

/**
 * Class m171210_105052_currency_permissions
 */
class m171210_105052_currency_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $currencyReadPerm = $am->createPermission('currency_read');
        $currencyCreatePerm = $am->createPermission('currency_create');
        $currencyUpdatePerm = $am->createPermission('currency_update');
        $currencyDeletePerm = $am->createPermission('currency_delete');

        $am->add($currencyReadPerm);
        $am->add($currencyCreatePerm);
        $am->add($currencyUpdatePerm);
        $am->add($currencyDeletePerm);

        $am->addChild($managerRole, $currencyReadPerm);
        $am->addChild($managerRole, $currencyCreatePerm);
        $am->addChild($managerRole, $currencyUpdatePerm);
        $am->addChild($managerRole, $currencyDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $currencyReadPerm = $am->getPermission('currency_read');
        $currencyCreatePerm = $am->getPermission('currency_create');
        $currencyUpdatePerm = $am->getPermission('currency_update');
        $currencyDeletePerm = $am->getPermission('currency_delete');

        $am->removeChild($managerRole, $currencyReadPerm);
        $am->removeChild($managerRole, $currencyCreatePerm);
        $am->removeChild($managerRole, $currencyUpdatePerm);
        $am->removeChild($managerRole, $currencyDeletePerm);

        $am->remove($currencyDeletePerm);
        $am->remove($currencyUpdatePerm);
        $am->remove($currencyCreatePerm);
        $am->remove($currencyReadPerm);
    }
}
