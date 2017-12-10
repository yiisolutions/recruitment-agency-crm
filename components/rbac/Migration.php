<?php

namespace app\components\rbac;

use Yii;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

class Migration extends \yii\db\Migration
{
    /**
     * @throws InvalidConfigException
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
}