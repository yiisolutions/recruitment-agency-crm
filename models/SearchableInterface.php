<?php

namespace app\models;

use yii\data\DataProviderInterface;

interface SearchableInterface
{
    const EVENT_BEFORE_SEARCH = 'beforeSearch';

    /**
     * Search data.
     *
     * @param array $params
     * @return DataProviderInterface
     */
    public function search($params);
}