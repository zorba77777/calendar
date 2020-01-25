<?php

namespace app\components;

use app\models\Users;
use yii\base\Component;

class AuthComponent extends Component
{
    public function signIn(Users &$model):bool {

        $model->setScenarioSignIn();

        if(!$model->validate(['email','password'])){
            return false;
        }

        $user=$this->getUserByEmail($model->email);

        if(!$this->validatePassword($model->password,$user->password_hash)){
            $model->addError('password','Bad password');
            return false;
        }

        return \Yii::$app->user->login($user,3600);
    }

    private function getUserByEmail($email):Users{

        return Users::find()->andWhere(['email'=>$email])->one();
    }

    private function validatePassword($password,$password_hash):bool{

        return \Yii::$app->security->validatePassword($password,$password_hash);
    }

    public function signUp(Users &$model):bool{

        $model->setScenarioSignUp();

        if(!$model->validate(['password','email'])){
            return false;
        }

        $model->password_hash=$this->generatePasswordHash($model->password);

        if(!$model->save()){
            return false;
        }

        return true;
    }

    public function generatePasswordHash($password){

        return \Yii::$app->security->generatePasswordHash($password);
    }
}