<?php

namespace app\controllers;

use app\base\BaseWebController;
use app\controllers\actions\ActivityCreateAction;
use app\controllers\actions\ActivityViewAction;


class ActivityController extends BaseWebController
{
    public function actions()
    {
        return [
            'create' => ['class' => ActivityCreateAction::class],
            'view' => ['class' => ActivityViewAction::class]
        ];
    }

}