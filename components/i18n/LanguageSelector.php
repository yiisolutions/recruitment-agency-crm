<?php

namespace app\components\i18n;

use app\models\User;
use yii\web\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;

class LanguageSelector extends Component implements BootstrapInterface
{
    public $supportedLanguages = [];

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (false === ($preferredLanguage = $this->lookUpInUserModel($app))) {
            if (false === ($preferredLanguage = $this->lookUpInCookie($app))) {
                $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
            }
        }

        $app->language = $preferredLanguage;
    }

    /**
     * @param Application $app
     * @return bool|string
     */
    private function lookUpInCookie($app)
    {
        if ($app->request->cookies->has('language')) {
            return $app->request->cookies->get('language')->value;
        }

        return false;
    }

    /**
     * @param Application $app
     * @return bool|string
     */
    private function lookUpInUserModel($app)
    {
        if ($app->user->isGuest) {
            return false;
        }

        /** @var User $user */
        $user = $app->user->getIdentity();

        if (empty($user->language)) {
            return false;
        }

        return $user->language->code;
    }
}