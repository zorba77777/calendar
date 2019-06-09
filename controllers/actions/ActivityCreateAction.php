<?php


namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\models\Activity;
use Yii;
use yii\base\Action;

class ActivityCreateAction extends Action
{
    public function run() {

        $model = new Activity();

        /** @var ActivityComponent $comp */
        $comp = Yii::createObject([
            'class' => \app\components\ActivityComponent::class,
            'modelClass' => 'app\models\Activity'
        ]);

        $model = $comp->getModel();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            if (Yii::$app->activity->createActivity($model)) {

            };
        }

        return $this->controller->render('create', ['model' => $model]);
    }

}

