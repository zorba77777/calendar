<?php
/* @var $this \yii\web\View */
?>

<div class="row">
    <div class="col-md-6">
        <pre>
            <?=print_r($users);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($acitivityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($firstActivity);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            Всего активностей: <?=$cnt;?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php foreach ($reader as $data):?>
                <?=print_r($data);?>
            <?php endforeach;?>
        </pre>
    </div>
</div>
