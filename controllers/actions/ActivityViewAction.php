<?php

namespace app\controllers\actions;

use yii\base\Action;
use yii\web\HttpException;

class ActivityViewAction extends Action
{
    /**
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function run($id){
        $model=\Yii::$app->activity->findActivityByID($id);
        if(!$model){
            throw new HttpException(404,'activity not found');
        }
        if(!\Yii::$app->rbac->canViewOrEditActivity($model)){
            throw new HttpException(403, 'not permission');
        }
        return $this->controller->render('view',['model'=>$model]);
    }
}