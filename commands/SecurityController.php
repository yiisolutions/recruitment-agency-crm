<?php

namespace app\commands;

use Yii;
use yii\base\Exception;
use yii\console\Controller;

/**
 * Security commands
 *
 * @package app\commands
 */
class SecurityController extends Controller
{
    /**
     * Generate password hash
     *
     * @param $password
     */
    public function actionPasswordHash($password)
    {
        try {
            $this->stdout(Yii::$app->security->generatePasswordHash($password) . "\n");
        } catch (Exception $e) {
            $this->stderr($e->getMessage() . "\n");
        }
    }
}