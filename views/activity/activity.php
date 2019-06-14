
<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $model \app\models\Activity
 */
?>


<?= Html::tag('h2', Html::encode($model->title)) ?>

<?= Html::tag('h3', Html::encode($model->description)) ?>

<?= Html::tag('h3', Html::encode($model->dateStart)) ?>

<?= Html::tag('h3', Html::encode($model->dateFinish)) ?>

<h3> <?php echo 'Blocking activity: ',($model->isBlocking ? 'yes' : 'no'); ?> </h3>

<h3> <?php echo 'Repeating activity: ',($model->isRepeating ? 'yes' : 'no'); ?> </h3>

<?= Html::tag('h3', Html::encode($model->email)) ?>

<h3> <?php echo 'Notification usage: ',($model->useNotification ? 'yes' : 'no'); ?> </h3>

<?= Html::tag('h3', "Frequency of notification: " . Html::encode($model->repeatType)) ?>

<p><?= Html::img("/images/$model->img",['width'=>200])?></p>

<?= Html::a( 'Back to activity edit', Url::to([
        'activity/create',
    'title' => $model->title,
    'description' => $model->description,
    'dateStart' => $model->dateStart,
    'dateFinish' => $model->dateFinish,
    'isBlocking' => $model->isBlocking,
    'isRepeating' => $model->isRepeating,
    'email' => $model->email,
    'useNotification' => $model->useNotification,
    'repeatType' => $model->repeatType,
    'img' => $model->img
])); ?>


