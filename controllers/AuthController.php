<?php

namespace app\controllers;

use app\base\BaseWebController;
use app\components\AuthComponent;
use app\models\Users;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     *
     * @return AuthComponent
     */
    private function getAuthComp(){

        return \Yii::$app->auth;
    }

    public function actionSignUp(){

        $model = new Users();

        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            if($this->getAuthComp()->signUp($model)){
                return $this->redirect(['auth/sign-in']);
            }
        }

        return $this->render('signup',['model'=>$model]);
    }

    public function actionSignIn() {

        $model = new Users();

        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            if($this->getAuthComp()->signIn($model)){
                return $this->redirect(['/activity/create']);
            }
        }

        return $this->render('signin',['model' => $model]);
    }
}