<?php
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

use app\models\Accounts;
use app\models\Projects;
use app\models\Departments;

?>
<div class="account row">
    <?php
        // necessary for update action.
        if (! $model->isNewRecord) {
            echo Html::activeHiddenInput($model, "[{$key}]id");
        }
    ?>
    <div class="col-sm-4 col-md-4">
        <?= $form->field($model, "[{$key}]account_id")->dropDownList(
            ArrayHelper::map(Accounts::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
            ['prompt'=>'* Pilih Account *']                          // options
        ); ?>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <?= $form->field($model, "[{$key}]debet_real")->textInput(['maxlength' => true, 'style' => 'text-align:right;']) ?>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <?= $form->field($model, "[{$key}]credit_real")->textInput(['maxlength' => true, 'style' => 'text-align:right;']) ?>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <?= $form->field($model, "[{$key}]department_id")->dropDownList(
            ArrayHelper::map(Departments::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
            ['prompt'=>'* Pilih Department *']                          // options
        ); ?>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <?= $form->field($model, "[{$key}]project_id")->dropDownList(
            ArrayHelper::map(Projects::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
            ['prompt'=>'* Pilih Project *']                          // options
        ); ?>
    </div>
    <div class="col-xs-11 col-sm-5 col-md-11">
        <?= $form->field($model, "[{$key}]remarks")->textInput(['maxlength' => true]) ?>
    </div>
    <!-- start col -->
    <div class="col-xs-1 col-sm-1 col-md-1" style="padding-top:30px">
        <a data-action="delete"><span class="glyphicon glyphicon-trash"></span></a>
        <?php if (!$model->isNewRecord): ?>
            <?= $form->field($model,"[$key]id")->hiddenInput()->label(false) ?>
        <?php endif; ?>
    </div>
    <!-- end col -->
</div><!-- .row -->

