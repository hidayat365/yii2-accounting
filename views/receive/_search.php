<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReceiveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'journal_num') ?>
    <?= $form->field($model, 'journal_date') ?>
    <?= $form->field($model, 'journal_value') ?>
    <?= $form->field($model, 'journal_value_real') ?>

    <?php // echo $form->field($model, 'posted') ?>
    <?php // echo $form->field($model, 'payment') ?>
    <?php // echo $form->field($model, 'closing') ?>
    <?php // echo $form->field($model, 'remarks') ?>
    <?php // echo $form->field($model, 'type_id') ?>
    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'currency_id') ?>
    <?php // echo $form->field($model, 'currency_rate1') ?>
    <?php // echo $form->field($model, 'currency_rate2') ?>
    <?php // echo $form->field($model, 'currency_reval') ?>

    <?php // echo $form->field($model, 'reference_id') ?>
    <?php // echo $form->field($model, 'reference_num') ?>
    <?php // echo $form->field($model, 'reference_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>
    <?php // echo $form->field($model, 'created_on') ?>
    <?php // echo $form->field($model, 'modified_by') ?>
    <?php // echo $form->field($model, 'modified_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
