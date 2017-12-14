<?php

namespace app\models\behaviors;

use app\models\events\SearchEvent;
use app\models\SearchableInterface;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

class FilterTimestampRange extends Behavior
{
    public $dbAttribute;
    public $rangeAttribute;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->dbAttribute)) {
            throw new InvalidConfigException('Db attribute must be set');
        }

        if (empty($this->rangeAttribute)) {
            $this->rangeAttribute = $this->dbAttribute . '_range';
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            SearchableInterface::EVENT_BEFORE_SEARCH => 'beforeSearch',
        ];
    }

    /**
     * Handle before search event
     *
     * @param SearchEvent $event
     */
    public function beforeSearch(SearchEvent $event)
    {
        $range = $event->sender->{$this->rangeAttribute};

        Yii::trace("{$this->rangeAttribute} is '{$range}'", __METHOD__);

        if (!empty($range)) {
            list($from, $to) = explode(' - ', $range);

            Yii::trace("from is '$from', to is '$to'", __METHOD__);

            if (!empty($from)) {
                $event->query->andFilterWhere(['>=', $this->dbAttribute, $from . ' 00:00:00']);
            }

            if (!empty($to)) {
                $event->query->andFilterWhere(['<=', $this->dbAttribute, $to . ' 23:59:59']);
            }
        }
    }
}