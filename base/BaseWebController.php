<?php


namespace app\base;

use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;


class BaseWebController extends Controller
{

    /**
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {

        Yii::$app->session->set('previousUrl', Yii::$app->request->referrer ?: Yii::$app->homeUrl);

        return parent::beforeAction($action);
    }

}