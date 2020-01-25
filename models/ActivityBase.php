<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $startDate
 * @property string $endDate
 * @property int $isBlocking
 * @property int $isRepeating
 * @property string $email
 * @property string $created_at
 * @property int $user_id
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'startDate', 'user_id'], 'required'],
            [['description'], 'string'],
            [['startDate', 'endDate', 'created_at'], 'safe'],
            [['isBlocking', 'isRepeating', 'user_id'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'startDate' => Yii::t('app', 'Start Date'),
            'endDate' => Yii::t('app', 'End Date'),
            'isBlocking' => Yii::t('app', 'Is Blocked'),
            'isRepeating' => Yii::t('app', 'Is Repeat'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
