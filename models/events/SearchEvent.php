<?php

namespace app\models\events;

use app\models\SearchableInterface;
use yii\base\Event;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class SearchEvent extends Event
{
    /**
     * @var ActiveRecord|SearchableInterface
     */
    public $sender;

    /**
     * @var ActiveQuery
     */
    public $query;
}