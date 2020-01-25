<?php

namespace app\controllers\actions;

use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActivityCreateAction extends Action
{
    /**
     * @return array|string
     * @throws HttpException
     */
    public function run(){

        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403,'Not allowed');
        }

        $model = new Activity();


        if (\Yii::$app->request->isPost) {

            $model->load(\Yii::$app->request->post());

            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if(\Yii::$app->activity->createActivity($model)){
                return $this->controller->render('activity',['model' => $model]);
            }
        }

        if (\Yii::$app->request->isGet) {

            $model->title = \Yii::$app->request->get('title');
            $model->description = \Yii::$app->request->get('description');
            $model->startDate = \Yii::$app->request->get('startDate');
            $model->endDate = \Yii::$app->request->get('endDate');
            $model->email = \Yii::$app->request->get('email');
            $model->repeatType = \Yii::$app->request->get('repeatType');
            $model->isRepeating = \Yii::$app->request->get('isRepeating');
            $model->isBlocking = \Yii::$app->request->get('isBlocking');
            $model->useNotification = \Yii::$app->request->get('useNotification');
        }

        return  $this -> controller -> render('create', ['model'=>$model]);
    }
}

