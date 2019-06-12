<?php
namespace app\components;
use app\models\Activity;
use yii\base\Component;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
class ActivityComponent extends Component
{
    public $modelClass;
    /**
     * @return Model
     */
    public function getModel(){
        return new $this->$modelClass;
    }
    public function createActivity(activity &$model):bool{
        $model->img=UploadedFile::getInstance($model,'img');
        if ($model->validate()){
            if($model->img && $this->saveFile($model->img,$file_name)){
                $model->img=$file_name;
            }
            return true;
        }
        return false;
    }
    private function saveFile(UploadedFile $file, &$file_name):bool{
        $file_name=$this->genNameFile($file);
        $path=$this->genPathToSaveFile($file_name);
        return $file->saveAs($path);
    }
    private function genPathToSaveFile($file_name):string {
        FileHelper::createDirectory(\Yii::getAlias('@webroot'.DIRECTORY_SEPARATOR.'images'));
        $path=\Yii::getAlias('@webroot'.DIRECTORY_SEPARATOR.'images'.
            DIRECTORY_SEPARATOR.$file_name);
        return $path;
    }
    private function genNameFile(UploadedFile $file):string {
        return $file->name.'_'.mt_rand(0,9999).'_'.time().'.'.$file->extension;
    }
}