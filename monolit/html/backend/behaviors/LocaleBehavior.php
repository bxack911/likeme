<?php

namespace backend\behaviors;

use Yii;
use yii\web\Application;
use yii\base\Behavior;

/**
 * Class LocaleBehavior
 * @package common\behaviors
 */
class LocaleBehavior extends Behavior
{
    /**
     * @var string
     */
    public $cookieName = '_language';

    /**
     * @var bool
     */
    public $enablePreferredLanguage = true;
    /**
     * @return array
     */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest'
        ];
    }

    /**
     * Resolve application language by checking user cookies, preferred language and profile settings
     */
    public function beforeRequest()
    {
//        if (
//            Yii::$app->getRequest()->getCookies()->has($this->cookieName)
//            && !Yii::$app->session->hasFlash('forceUpdateLocale')
//        )
        if (
            Yii::$app->config->has('backendLanguage')
            && !Yii::$app->session->hasFlash('forceUpdateLocale')
        ) {
            //$userLocale = Yii::$app->getRequest()->getCookies()->getValue($this->cookieName);
            $userLocale = Yii::$app->config->get('backendLanguage');
        } else {
            $userLocale = Yii::$app->language;
            if ($this->enablePreferredLanguage) {
                $userLocale = Yii::$app->request->getPreferredLanguage($this->getAvailableLanguages());
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => $this->cookieName,
                    'value' => $userLocale,
                ]));
            }
        }
        Yii::$app->language = $userLocale;
    }

    /**
     * @return array
     */
    protected function getAvailableLanguages()
    {
        return array_keys(Yii::$app->params['languages']);
    }
}
