<?php

namespace app\widgets;

use kartik\select2\Select2;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\JsExpression;

class AjaxDropDownWidget extends Select2
{
    public $allowClear = true;
    public $minimumInputLength = false;
    public $controller = 'ajax-drop-down';
    public $action;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->action)) {
            throw new InvalidConfigException('Entity must be set');
        }

        $this->pluginOptions = [
            'allowClear' => $this->allowClear,
            'minimumInputLength' => $this->minimumInputLength,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => Url::to(['/' . $this->controller . '/' . $this->action]),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {query: params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(entity) { return entity.text; }'),
            'templateSelection' => new JsExpression('function (entity) { return entity.text; }'),
        ];
        parent::init();
    }
}