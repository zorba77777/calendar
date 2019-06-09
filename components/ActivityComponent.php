<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\base\Model;

class ActivityComponent extends Component
{

    public $modelClass;


    /**
     * @return Model
     */
    public function getModel() {

        return new $this->modelClass;

    }

    public function createActivity(Activity &$model): bool {

        if ($model->validate()) {
            return true;
        } else {
            return false;
        }
    }

}