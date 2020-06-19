<?php

namespace frontend\components;

use Yii;
use yii\base\BaseObject;
use yii\web\UrlRuleInterface;
use yii\web\NotFoundHttpException;
use common\models\Routes;

class SlugRouteRule extends BaseObject implements UrlRuleInterface
{
    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        $url = $request->getPathInfo();

        /* index page stored in db as "index" not "" */
        if($url == '') $url = 'index';

        $routeModel = Routes::find()->where(['url' => $url])->one();

        if($routeModel) {
            return [$routeModel->route, ['id' => $routeModel->model_id]];
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function createUrl($manager, $route, $params)
    {
        $routeModel = null;
        if(isset($params['id'])) {
            $routeModel = Routes::find()->where(['route' => $route, 'model_id' => $params['id']])->one();
            unset($params['id']);
        }

        if($routeModel) {

            $url = $routeModel->url;

            /* index page stored in db as "index" not "" */
            if($url == 'index') $url = '';

            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }

            return $url;
        }
        return false;
    }
}