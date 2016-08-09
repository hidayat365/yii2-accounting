<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\modules\accounting\models\Accounts;

/* @var $this yii\web\View */
/* @var $model app\modules\accounting\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_id')->hiddenInput()->label(false) ?>
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

<?php /*
<?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'bank_accnum')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'bank_accname')->textInput(['maxlength' => true]) ?>
*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
