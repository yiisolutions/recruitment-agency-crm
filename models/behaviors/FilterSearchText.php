<?php

namespace app\models\behaviors;

use app\models\events\SearchEvent;
use app\models\SearchableInterface;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

class FilterSearchText extends Behavior
{
    public $textAttribute = 'search_text';
    public $fieldsAttribute = 'search_fields';

    /**
     * @var array
     */
    public $searchableFields;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->searchableFields)) {
            throw new InvalidConfigException('Searchable fields must be set');
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
        $text = $event->sender->{$this->textAttribute};
        $fields = $event->sender->{$this->fieldsAttribute};

        if (!empty($text)) {
            $or = ['or'];

            foreach ($fields as $field) {
                if (in_array($field, $this->searchableFields)) {
                    $or[] = ['like', $field, $text];
                }
            }

            if (count($or) > 1) {
                $event->query->andFilterWhere($or);
            }
        }
    }
}