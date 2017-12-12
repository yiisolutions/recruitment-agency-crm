<?php

namespace app\widgets;

use Yii;
use yii\base\Model;
use yii\base\Widget;
use yii\data\DataProviderInterface;
use yii\web\User;
use yiister\gentelella\widgets\grid\GridView;
use yiister\gentelella\widgets\Panel;

class GridViewPanel extends Widget
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $header;

    /**
     * @var bool
     */
    public $collapsable = false;

    /**
     * @var array|string
     */
    public $createUrl = ['create'];

    /**
     * @var array
     */
    public $permissionNamesMap = [];

    /**
     * @var DataProviderInterface
     */
    public $dataProvider;

    /**
     * @var Model
     */
    public $filterModel;

    /**
     * @var array
     */
    public $columns = [];

    /**
     * @var bool
     */
    public $showActionColumn = true;

    public function init()
    {
        parent::init();

        if (empty($this->user)) {
            $this->user = Yii::$app->getUser();
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        Panel::begin([
            'header' => $this->header,
            'collapsable' => $this->collapsable,
            'tools' => [
                [
                    'label' => '<i class="fa fa-plus text-success"></i>',
                    'encode' => false,
                    'url' => $this->createUrl,
                    'visible' => isset($this->permissionNamesMap['create']) && $this->user->can($this->permissionNamesMap['create']),
                ],
            ],
        ]);

        $columns = $this->columns;

        if ($this->showActionColumn) {
            array_push($columns, [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Actions'),
                'visibleButtons' => [
                    'view' => isset($this->permissionNamesMap['view']) && $this->user->can($this->permissionNamesMap['view']),
                    'update' => isset($this->permissionNamesMap['update']) && $this->user->can($this->permissionNamesMap['update']),
                    'delete' => isset($this->permissionNamesMap['delete']) && $this->user->can($this->permissionNamesMap['delete']),
                ],
            ]);
        }

        echo GridView::widget([
            'bordered' => false,
            'hover' => true,
            'dataProvider' => $this->dataProvider,
            'filterModel' => $this->filterModel,
            'columns' => $columns,
        ]);

        Panel::end();
    }
}