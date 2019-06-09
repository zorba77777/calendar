<?php


namespace app\models;


use yii\base\Model;

class Activity extends Model
{

    public $title;

    public $description;

    public $dateStart;

    public $dateFinish;

    public $isBlocked;

    public $isRepeat;

    public function rules(){

        return [
            ['title', 'string', 'min' => 5],
            ['title', 'required'],
            ['description', 'string'],
            ['isBlocked', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title of event',
            'description' => 'Description of event',
            'isBlocked' => 'Does the event block others'
        ];
    }

}