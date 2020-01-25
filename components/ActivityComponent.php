<?php

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $modelClass;
    /**
     * return Model
     */

    public function getModel(){

        return new $this->modelClass;
    }

    public function createActivity(Activity &$model):bool{

        $model->img = UploadedFile::getInstance($model,'img');

        $model->user_id = \Yii::$app->user->id;

        if ($model->save()){
            if($model->img && $this->saveFile($model->img,$file_name)){
                $model->img=$file_name;
            }
            return true;
        }
        return false;
    }

    public function findActivityByID($id):?Activity {

        return Activity::find()->andWhere(['id'=>$id])->one();
    }

    private function saveFile (UploadedFile $file, &$file_name):bool{

        $file_name=$this->genNameFile($file);
        $path=$this->genPathToSaveFile($file_name);
        return $file->saveAs($path);
    }

    /**
     * @param $file_name
     * @return string
     */
    private function genPathToSaveFile($file_name):string {

        try {
            FileHelper::createDirectory(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'images');
        } catch (Exception $e) {
        }
        $path=\Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.'images'.
            DIRECTORY_SEPARATOR.$file_name;
        return $path;
    }

    private function genNameFile(UploadedFile $file):string {

        return $file->name.'_'.mt_rand(0,9999).'_'.time().'.'.$file->extension;
    }
}