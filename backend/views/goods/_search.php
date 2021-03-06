<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cate_guid') ?>

    <?= $form->field($model, 'user_guid') ?>

    <?= $form->field($model, 'fours_guid') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
