<?php
namespace app\models;

use app\models\validations\StopPhraseValidation;
use yii\base\Model;

class Activity extends Model
{
    public  $title;
    public  $description;
    public  $dateStart;
    public  $dateFinish;
    public  $isBlocking;
    public  $isRepeating;
    public  $email;
    public  $emailRepeat;
    public  $useNotification;
    public $repeatType;
    public $img;

    public const REPEAT_TYPE=['1d'=>'Every day','1w'=>'Every week'];

    public function beforeValidate()
    {
        if($this->dateStart){
            if($date=\DateTime::createFromFormat('d.m.Y',$this->dateStart)){
                $this->dateStart=$date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function rules(){

        return [
            ['title', 'string', 'min' => 5,'max' => '255'],
            ['title','trim'],
            ['img','file','extensions' => ['jpg','png']],
            ['title', 'required'],
            ['title', StopPhraseValidation::class],
            ['dateStart','date','format' => 'php:Y-m-d'],
            ['description', 'string','max' => 2000],
            [['isBlocking','useNotification'], 'boolean'],
            ['email','email'],

            ['email','required','when' => function($model){
                return $model->useNotification;
            }],
            ['emailRepeat','compare','compareAttribute' => 'email'],
            ['repeatType','in','range' => array_keys(self::REPEAT_TYPE)]
        ];
    }

    public function stopPhraseTitle($attr){

        if(in_array($this->title,['shawarma','curb'])){
            $this->addError($attr,'This name of activity is not permitted');
        }
    }

    public function attributeLabels(){

        return [
            'title' => 'Activity title',
            'description' => 'Activity description',
            'isBlocking' => 'Blocking activity'
        ];
    }

}