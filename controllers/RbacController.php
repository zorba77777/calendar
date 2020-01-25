<?php

namespace app\controllers;

use app\base\BaseWebController;

class RbacController extends BaseWebController
{
    public function actionGen(){

        \Yii::$app->rbac->gen();
    }
}