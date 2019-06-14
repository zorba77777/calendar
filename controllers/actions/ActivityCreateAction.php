<?php

namespace app\controllers\actions;

use app\models\Activity;
use yii\base\Action;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActivityCreateAction extends Action
{
    public function run(){

        $model = new Activity();


        if (\Yii::$app->request->isPost) {

            $model->load(\Yii::$app->request->post());

            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if(\Yii::$app->activity->createActivity($model)){
                return $this->controller->render('activity',['model'=>$model]);
            }
        }

        if (\Yii::$app->request->isGet) {

            $model->title = \Yii::$app->request->get('title');
            $model->description = \Yii::$app->request->get('description');
            $model->dateStart = \Yii::$app->request->get('dateStart');
            $model->dateFinish = \Yii::$app->request->get('dateFinish');
            $model->email = \Yii::$app->request->get('email');
            $model->repeatType = \Yii::$app->request->get('repeatType');
            $model->isRepeating = \Yii::$app->request->get('isRepeating');
            $model->isBlocking = \Yii::$app->request->get('isBlocking');
            $model->useNotification = \Yii::$app->request->get('useNotification');
        }

        return  $this -> controller -> render('create', ['model'=>$model]);
    }
}

