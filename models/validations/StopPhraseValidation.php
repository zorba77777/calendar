<?php
namespace app\models\validations;

use yii\validators\Validator;

class StopPhraseValidation extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if(in_array($model->$attribute,['шаурма','бордюр'])){
            $model->addError($attribute,'Недопустимое название события');
        }
    }
}