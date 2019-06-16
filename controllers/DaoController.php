<?php

namespace app\controllers;

use app\base\BaseWebController;
use app\components\DaoComponent;
use yii\base\InvalidConfigException;

class DaoController extends BaseWebController
{
    /**
     * @return string
     * @throws \Throwable
     */
    public function actionTest(){

        try {
            $comp = \Yii::createObject(DaoComponent::class);
        } catch (InvalidConfigException $e) {
        }

        $users=$comp->getUsersAll();
        $activityUser=$comp->getActivityUser(\Yii::$app->request->get('user'));
        $firstActivity=$comp->getFirstBlocking();
        $cnt=$comp->getCountActivity();
        $reader=$comp->getBigData();
        $comp->insertsTransaction();
        return $this->render('test', [
            'users' => $users,
            'acitivityUser' => $activityUser,
            'firstActivity' => $firstActivity,
            'cnt' => $cnt,'reader' => $reader
        ]);
    }
}