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

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-book"></i> 
                <?= $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') ?>
                Department Details
            </h4>
        </div>

        <div class="panel-body">

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
    <?= $form->field($model, 'created_by')->textInput() ?>
    <?= $form->field($model, 'created_on')->textInput() ?>
    <?= $form->field($model, 'modified_by')->textInput() ?>
    <?= $form->field($model, 'modified_on')->textInput() ?>
    */ ?>

    <?php ActiveForm::end(); ?>

</div>
