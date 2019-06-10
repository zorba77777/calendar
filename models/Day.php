<?php


namespace app\models;


use yii\base\Model;

class Day extends Model
{

    /** @var $isWorkingDay boolean */
    public $isWorkingDay;

    /** @var $activities Activity[] */
    public $activities = [];

    public function rules(){

        return [
            ['isWorkingDay', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'isWorkingDay' => 'Is this day working?'
        ];
    }

}