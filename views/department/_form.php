<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Departments;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'active')->checkBox() ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'parent_id')
        ->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Departments::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => 'Select Department ...'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

    <?php /*
    <?= $form->field($model, 'manager_id')->textInput() ?>
    <?= $form->field($model, 'created_by')->textInput() ?>
    <?= $form->field($model, 'created_on')->textInput() ?>
    <?= $form->field($model, 'modified_by')->textInput() ?>
    <?= $form->field($model, 'modified_on')->textInput() ?>
    */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
