<?php

use app\components\rbac\Migration;

/**
 * Class m171210_115656_create_dashboard_read
 */
class m171210_115656_create_dashboard_read extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $dashboardReadPerm = $am->createPermission('dashboard_read');
        
        $am->add($dashboardReadPerm);

        $am->addChild($managerRole, $dashboardReadPerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $dashboardReadPerm = $am->createPermission('dashboard_read');

        $am->removeChild($managerRole, $dashboardReadPerm);
        
        $am->remove($dashboardReadPerm);
    }
}
