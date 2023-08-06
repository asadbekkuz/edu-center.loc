<?php

namespace common\components\i18n;


use Yii;
use yii\base\Behavior;
use yii\web\Application;

class Language extends Behavior
{
    public function events()
    {
        return [ Application::EVENT_BEFORE_REQUEST => 'setLanguage'];
    }

    public function setLanguage()
    {
        if(Yii::$app->session->has('language'))
        {
            Yii::$app->language = Yii::$app->session->get('language');
        }
    }
}