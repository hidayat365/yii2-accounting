<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\assets\JournalAsset;
use app\models\JournalTypes;
use app\models\JournalDetails;
use app\models\Accounts;
use app\models\Currencies;
use app\models\Projects;
use app\models\Departments;

use mdm\widgets\GridInput;
use mdm\widgets\TabularInput;

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

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-book"></i> 
                <?= $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update') ?>
                Journal Header
            </h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <?= $form->field($model, 'journal_num')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
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

                <div class="col-xs-12 col-sm-6 col-md-3">
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
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <?= $form->field($model, 'currency_rate1')->widget(NumberControl::classname()) ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
                </div>
            </div><!-- .row -->
        </div>
    </div>


    <div class="panel panel-info">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> Journal Details</h4></div>
        <div class="panel-body">
            <!-- start form-group -->
            <div class="form-group">
                <a id="btn-add" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add New Row</a>
            </div>
            <!-- end form-group -->
            <!-- start form-group -->
            <div class="form-group">
                <?= TabularInput::widget([
                    'id' => 'detail-grid',
                    'allModels' => $model->journalDetails,
                    'model' => JournalDetails::className(),
                    'form' => $form,
                    'itemOptions' => ['tag' => 'div'],
                    'itemView' => '_details',
                    'clientOptions' => [
                    'btnAddSelector' => '#btn-add',
                    ]
                ]); ?>
            </div>
            <!-- end form-group -->
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
                ]) ?>
                <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
