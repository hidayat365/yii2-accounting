<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Accounts;

/* @var $this yii\web\View */
/* @var $model app\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-book"></i> 
                <?= $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') ?>
                Account Details
            </h4>            
        </div>

        <div class="panel-body">

            <?= $form->field($model, 'active')->checkBox() ?>
            <?= $form->field($model, 'checking')->checkBox() ?>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'parent_id')
                ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Accounts::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Account ...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]); ?>
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

    <?php /*
    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bank_accnum')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bank_accname')->textInput(['maxlength' => true]) ?>
    */ ?>


    <?php ActiveForm::end(); ?>

</div>
