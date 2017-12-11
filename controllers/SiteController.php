<?php

namespace app\controllers;

use app\models\Language;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'language' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Change current language.
     *
     * @return string
     */
    public function actionLanguage()
    {
        $user = Yii::$app->user;
        $response = Yii::$app->getResponse();
        $request = Yii::$app->getRequest();
        $languageID = isset($request->bodyParams['language_id']) ? $request->bodyParams['language_id'] : null;
        $language = Language::findOne($languageID);

        if ($language) {
            $cookie = new Cookie();
            $cookie->name = 'language';
            $cookie->value = $language->code;
            $response->cookies->add($cookie);

            if (!$user->isGuest) {
                /** @var User $userModel */
                $userModel = $user->getIdentity();
                $userModel->language_id = $language->id;

                if (!$userModel->save(false, ['language_id'])) {
                    Yii::warning('Save user language error');
                }
            }
        }

        return $this->redirect($request->referrer ?: Yii::$app->homeUrl);
    }
}
