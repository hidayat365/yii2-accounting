<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\assets\JournalAsset;
use app\models\JournalTypes;
use app\models\Accounts;
use app\models\Currencies;
use app\models\Projects;
use app\models\Departments;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\number\NumberControl;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Journals */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="journals-form">

    <?php $form = ActiveForm::begin(['id' => 'journals-form']); ?>
    <?= $form->field($model, 'type_id')->hiddenInput()->label(false); ?>

    <div class="row">
        <div class="col-xs-6 col-sm-3 col-lg-4">
            <?= $form->field($model, 'journal_num')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-xs-6 col-sm-4 col-lg-3">
            <?= $form->field($model, 'journal_date')
                ->widget(DateControl::classname(), [
                    'type'=>DateControl::FORMAT_DATE,
                    'options' => [
                        'class' => 'form-control col-md-4',
                        'pluginOptions' => [
                            'autoclose' => true
                        ],
                    ],
                ]) ?>
        </div>

        <div class="col-xs-6 col-sm-3 col-lg-3">
            <?= $form->field($model, 'currency_id')
                ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Currencies::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select currency ...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
        </div>
        <div class="col-xs-6 col-sm-2 col-lg-2">
            <?= $form->field($model, 'currency_rate1')->widget(NumberControl::classname()) ?>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> Journal Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',  // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-accounts',          // required: css class selector
                'widgetItem' => '.account',                     // required: css class
                'limit' => 999,                                // the maximum times, an element can be cloned (default 999)
                'min' => 1,                                  // 0 or 1 (default 1)
                'insertButton' => '.add-account',               // css class
                'deleteButton' => '.remove-account',            // css class
                'model' => $details[0],
                'formId' => 'journals-form',
                'formFields' => [
                    'journal_id',
                    'account_id',
                    'item_id',
                    'debet',
                    'debet_real',
                    'credit',
                    'credit_real',
                    'quantity',
                    'remarks',
                ],
            ]); ?>

            <div class="container-accounts"><!-- widgetContainer -->
            <?php foreach ($details as $i => $detail): ?>
                <div class="account row">
                    <?php
                        // necessary for update action.
                        if (! $detail->isNewRecord) {
                            echo Html::activeHiddenInput($detail, "[{$i}]id");
                        }
                    ?>
                    <div class="col-sm-4 col-md-4">
                        <?= $form->field($detail, "[{$i}]account_id")->dropDownList(
                            ArrayHelper::map(Accounts::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                            ['prompt'=>'* Pilih Account *']                          // options
                        ); ?>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                        <?= $form->field($detail, "[{$i}]debet_real")->textInput(['maxlength' => true, 'style' => 'text-align:right;']) ?>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                        <?= $form->field($detail, "[{$i}]credit_real")->textInput(['maxlength' => true, 'style' => 'text-align:right;']) ?>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <?= $form->field($detail, "[{$i}]department_id")->dropDownList(
                            ArrayHelper::map(Departments::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                            ['prompt'=>'* Pilih Department *']                          // options
                        ); ?>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <?= $form->field($detail, "[{$i}]project_id")->dropDownList(
                            ArrayHelper::map(Projects::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                            ['prompt'=>'* Pilih Project *']                          // options
                        ); ?>
                    </div>
                    <div class="col-xs-10 col-sm-4 col-md-11">
                        <?= $form->field($detail, "[{$i}]remarks")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-1 detail-action">
                        <div class="pull-right">
                            <button type="button" class="add-account btn btn-success btn-xs">
                                <i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-account btn btn-danger btn-xs">
                                <i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                    </div>
                </div><!-- .row -->

            <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-warning' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
