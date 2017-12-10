<?php

use app\components\rbac\Migration;

/**
 * Class m171210_104354_resume_permissions
 */
class m171210_104354_resume_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $resumeReadPerm = $am->createPermission('resume_read');
        $resumeCreatePerm = $am->createPermission('resume_create');
        $resumeUpdatePerm = $am->createPermission('resume_update');
        $resumeDeletePerm = $am->createPermission('resume_delete');

        $am->add($resumeReadPerm);
        $am->add($resumeCreatePerm);
        $am->add($resumeUpdatePerm);
        $am->add($resumeDeletePerm);

        $am->addChild($managerRole, $resumeReadPerm);
        $am->addChild($managerRole, $resumeCreatePerm);
        $am->addChild($managerRole, $resumeUpdatePerm);
        $am->addChild($managerRole, $resumeDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $resumeReadPerm = $am->getPermission('resume_read');
        $resumeCreatePerm = $am->getPermission('resume_create');
        $resumeUpdatePerm = $am->getPermission('resume_update');
        $resumeDeletePerm = $am->getPermission('resume_delete');

        $am->removeChild($managerRole, $resumeReadPerm);
        $am->removeChild($managerRole, $resumeCreatePerm);
        $am->removeChild($managerRole, $resumeUpdatePerm);
        $am->removeChild($managerRole, $resumeDeletePerm);

        $am->remove($resumeDeletePerm);
        $am->remove($resumeUpdatePerm);
        $am->remove($resumeCreatePerm);
        $am->remove($resumeReadPerm);
    }
}
