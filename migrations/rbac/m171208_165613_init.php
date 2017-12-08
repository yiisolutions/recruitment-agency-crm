<?php

use yii\base\InvalidConfigException;
use yii\db\Migration;
use yii\rbac\DbManager;

/**
 * Class m171208_165613_init
 */
class m171208_165613_init extends Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $am = $this->getAuthManager();

        $userRole = $am->createRole('user');
        $managerRole = $am->createRole('manager');
        $adminRole = $am->createRole('admin');

        $am->add($userRole);
        $am->add($managerRole);
        $am->add($adminRole);

        $am->addChild($managerRole, $userRole);
        $am->addChild($adminRole, $managerRole);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $am = $this->getAuthManager();

        $userRole = $am->getRole('user');
        $managerRole = $am->getRole('manager');
        $adminRole = $am->getRole('admin');

        $am->removeChild($adminRole, $managerRole);
        $am->removeChild($managerRole, $userRole);

        $am->remove($adminRole);
        $am->remove($managerRole);
        $am->remove($userRole);
    }
}
