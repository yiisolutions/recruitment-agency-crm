<?php

namespace app\widgets;

use app\models\Language;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class LanguageSelector extends Widget
{
    public $formAction = ['/site/language'];
    public $formMethod = 'post';
    public $formOptions = [];
    public $ajaxDropDownOptions = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo Html::beginForm(
            $this->formAction,
            $this->formMethod,
            $this->formOptions
        );

        $currentLanguage = $this->findCurrentLanguage();

        echo Html::beginTag('div', ['class' => 'form-group', 'style' => 'padding:13px 15px 12px']);
        echo AjaxDropDownWidget::widget(ArrayHelper::merge([
            'name' => 'language_id',
            'value' => $currentLanguage ? $currentLanguage->id : null,
            'initValueText' => $currentLanguage ? Yii::t('app', $currentLanguage->title) : '',
            'options' => ['onchange' => 'this.form.submit()'],
            'action' => 'language',
            'allowClear' => false,
        ], $this->ajaxDropDownOptions));
        echo Html::endTag('div');

        echo Html::endForm();
    }

    /**
     * Find current application language.
     *
     * @return null|Language
     */
    private function findCurrentLanguage()
    {
        return Language::findOne(['code' => Yii::$app->language]);
    }
}