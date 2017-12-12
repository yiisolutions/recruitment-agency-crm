<?php

namespace app\widgets;

use Yii;
use yii\web\User;
use yiister\gentelella\widgets\Menu;

class SidebarMenu extends Menu
{
    /**
     * @var User
     */
    public $user;

    public function init()
    {
        parent::init();
        
        $this->items = [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => ['/dashboard/index'],
                'icon' => 'dashboard',
            ],
            [
                'label' => Yii::t('app', 'Customers'),
                'url' => '#',
                'icon' => 'square',
                'items' => [
                    [
                        'label' => Yii::t('app', 'Employers'),
                        'url' => ['/employer/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('employer_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Applicants'),
                        'url' => ['/applicant/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('applicant_read'),
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Content'),
                'url' => '#',
                'icon' => 'square',
                'items' => [
                    [
                        'label' => Yii::t('app', 'Vacancies'),
                        'url' => ['/vacancy/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('vacancy_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Resumes'),
                        'url' => ['/resume/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('resume_read'),
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'References'),
                'url' => '#',
                'icon' => 'square',
                'items' => [
                    [
                        'label' => Yii::t('app', 'Currencies'),
                        'url' => ['/currency/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('currency_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Locations'),
                        'url' => ['/location/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('location_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Scopes'),
                        'url' => ['/scope/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('scope_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Skills'),
                        'url' => ['/skill/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('skill_read'),
                    ],
                    [
                        'label' => Yii::t('app', 'Languages'),
                        'url' => ['/language/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('language_read'),
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Administration'),
                'url' => '#',
                'icon' => 'square',
                'items' => [
                    [
                        'label' => Yii::t('app', 'Users'),
                        'url' => ['/user/index'],
                        'icon' => 'square-o',
                        'visible' => $this->user->can('user_read'),
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Development'),
                'url' => '#',
                'icon' => 'code',
                'visible' => YII_ENV_DEV,
                'items' => [
                    [
                        'label' => Yii::t('app', 'Gii'),
                        'url' => ['/gii/default/index'],
                        'icon' => 'square-o',
                    ],
                    [
                        'label' => Yii::t('app', 'Debug'),
                        'url' => ['/debug/default/index'],
                        'icon' => 'square-o',
                    ],
                ],
            ],
        ];
    }
}