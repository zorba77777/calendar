<?php

namespace app\base;

use yii\web\Controller;

class BaseWebController extends Controller
{

    public function afterAction($action, $result) {

        \Yii::$app->session->setFlash('pageBack',\Yii::$app->request->pathInfo);
        return parent::afterAction($action, $result);
    }
}