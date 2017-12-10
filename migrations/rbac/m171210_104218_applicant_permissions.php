<?php

use app\components\rbac\Migration;

/**
 * Class m171210_104218_applicant_permissions
 */
class m171210_104218_applicant_permissions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $applicantReadPerm = $am->createPermission('applicant_read');
        $applicantCreatePerm = $am->createPermission('applicant_create');
        $applicantUpdatePerm = $am->createPermission('applicant_update');
        $applicantDeletePerm = $am->createPermission('applicant_delete');

        $am->add($applicantReadPerm);
        $am->add($applicantCreatePerm);
        $am->add($applicantUpdatePerm);
        $am->add($applicantDeletePerm);

        $am->addChild($managerRole, $applicantReadPerm);
        $am->addChild($managerRole, $applicantCreatePerm);
        $am->addChild($managerRole, $applicantUpdatePerm);
        $am->addChild($managerRole, $applicantDeletePerm);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $managerRole = $am->getRole('manager');

        $applicantReadPerm = $am->getPermission('applicant_read');
        $applicantCreatePerm = $am->getPermission('applicant_create');
        $applicantUpdatePerm = $am->getPermission('applicant_update');
        $applicantDeletePerm = $am->getPermission('applicant_delete');

        $am->removeChild($managerRole, $applicantReadPerm);
        $am->removeChild($managerRole, $applicantCreatePerm);
        $am->removeChild($managerRole, $applicantUpdatePerm);
        $am->removeChild($managerRole, $applicantDeletePerm);

        $am->remove($applicantDeletePerm);
        $am->remove($applicantUpdatePerm);
        $am->remove($applicantCreatePerm);
        $am->remove($applicantReadPerm);
    }
}
