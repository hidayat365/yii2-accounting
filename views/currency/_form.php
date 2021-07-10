<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Currencies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currencies-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-book"></i> 
                <?= $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') ?>
                Currency Details
            </h4>
        </div>

        <div class="panel-body">

        </div>

        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
                ]) ?>
                <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'active')->checkBox() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
