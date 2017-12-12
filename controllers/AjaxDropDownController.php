<?php

namespace app\controllers;

use app\models\Currency;
use app\models\Employer;
use app\models\Language;
use app\models\Location;
use yii\db\ActiveRecord;
use yii\rest\Controller;

/**
 * Ajax Drop Down Controller.
 *
 * @package app\controllers
 */
class AjaxDropDownController extends Controller
{
    /**
     * Return currencies list for select2 widgets.
     *
     * @param null $query
     * @param null $id
     * @return array
     */
    public function actionCurrency($query = null, $id = null)
    {
        return $this->getList(Currency::className(), $query, $id);
    }

    /**
     * Return employers list for select2 widgets.
     *
     * @param null $query
     * @param null $id
     * @return array
     */
    public function actionEmployer($query = null, $id = null)
    {
        return $this->getList(Employer::className(), $query, $id);
    }

    /**
     * Return languages list for select2 widgets.
     *
     * @param null $query
     * @param null $id
     * @return array
     */
    public function actionLanguage($query = null, $id = null)
    {
        return $this->getList(Language::className(), $query, $id);
    }

    /**
     * Return locations list for select2 widgets.
     *
     * @param null $query
     * @param null $id
     * @return array
     */
    public function actionLocation($query = null, $id = null)
    {
        return $this->getList(Location::className(), $query, $id);
    }

    /**
     * Return models list for select2 widgets.
     *
     * @param $modelClass
     * @param null $queryString
     * @param null $id
     * @return array
     */
    private function getList($modelClass, $queryString = null, $id = null)
    {
        if (!empty($queryString)) {
            $results = $this->getListByQueryString($modelClass, $queryString);
        } elseif (!empty($id)) {
            $results = $this->getListSelectedModel($modelClass, $id);
        } else {
            $results = $this->getListEmpty($modelClass);
        }

        return compact('results');
    }

    /**
     * Get list by query string.
     *
     * @param ActiveRecord $modelClass
     * @param string $queryString
     * @return array
     */
    private function getListByQueryString($modelClass, $queryString)
    {
        return $this->buildQuery($modelClass)
            ->where(['like', 'title', $queryString])
            ->all();
    }

    /**
     * Get list selected model.
     *
     * @param ActiveRecord $modelClass
     * @param integer $id
     * @return array
     */
    private function getListSelectedModel($modelClass, $id)
    {
        return [
            'id' => $id,
            'text' => $modelClass::findOne($id)->getAttribute('title'),
        ];
    }

    /**
     * Get list empty
     *
     * @param ActiveRecord $modelClass
     * @return mixed
     */
    private function getListEmpty($modelClass)
    {
        return $this->buildQuery($modelClass)->all();
    }

    /**
     * Build query.
     *
     * @param ActiveRecord $modelClass
     * @return \yii\db\ActiveQuery
     */
    private function buildQuery($modelClass)
    {
        return $modelClass::find()
            ->select('id, title as text')
            ->limit(20)
            ->orderBy('title')
            ->asArray();
    }
}