<?php

namespace app\components;

use app\rules\OwnerAcitivtyRule;
use yii\base\Component;
use yii\rbac\ManagerInterface;
class RbacComponent extends Component
{
    private function getAuthManager():ManagerInterface{

        return \Yii::$app->authManager;
    }

    public function gen(){

        $authManager=$this->getAuthManager();
        $authManager->removeAll();
        $admin= $authManager->createRole('admin');
        $user= $authManager->createRole('user');
        $authManager->add($admin);
        $authManager->add($user);
        $createActivity=$authManager->createPermission('createActivity');
        $createActivity->description='Создание активности';
        $authManager->add($createActivity);
        $viewEditOwnerActivity=$authManager->createPermission('viewEditOwnerActivity');
        $viewEditOwnerActivity->description='Редактировани и просмотр своего события';
        $rule=new OwnerAcitivtyRule();
        $authManager->add($rule);
        $viewEditOwnerActivity->ruleName=$rule->name;
        $authManager->add($viewEditOwnerActivity);
        $allPrivilege=$authManager->createPermission('allPrivilege');
        $allPrivilege->description='Полные права';
        $authManager->add($allPrivilege);
        $authManager->addChild($user,$createActivity);
        $authManager->addChild($user,$viewEditOwnerActivity);
        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$allPrivilege);
        $authManager->assign($admin,3);
        $authManager->assign($user,4);
    }

    public function canCreateActivity():bool{

        return \Yii::$app->user->can('createActivity');
    }

    public function canViewOrEditActivity($activity):bool{

        if(\Yii::$app->user->can('allPrivilege')){
            return true;
        }

        return \Yii::$app->user->can('viewEditOwnerActivity',[
            'activity'=>$activity
        ]);
    }
}