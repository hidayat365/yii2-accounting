<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\accounting\models\JournalsSearch */
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

    <?php // echo $form->field($model, 'branch_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'source_id') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'currency_rate1') ?>

    <?php // echo $form->field($model, 'currency_rate2') ?>

    <?php // echo $form->field($model, 'currency_reval') ?>

    <?php // echo $form->field($model, 'reference_id') ?>

    <?php // echo $form->field($model, 'reference_num') ?>

    <?php // echo $form->field($model, 'reference_date') ?>

    <?php // echo $form->field($model, 'order_id') ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'invoice_id') ?>

    <?php // echo $form->field($model, 'invoice_num') ?>

    <?php // echo $form->field($model, 'invoice_date') ?>

    <?php // echo $form->field($model, 'cost1_account_id') ?>

    <?php // echo $form->field($model, 'cost1_value') ?>

    <?php // echo $form->field($model, 'cost1_value_real') ?>

    <?php // echo $form->field($model, 'cost2_account_id') ?>

    <?php // echo $form->field($model, 'cost2_value') ?>

    <?php // echo $form->field($model, 'cost2_value_real') ?>

    <?php // echo $form->field($model, 'cost3_account_id') ?>

    <?php // echo $form->field($model, 'cost3_value') ?>

    <?php // echo $form->field($model, 'cost3_value_real') ?>

    <?php // echo $form->field($model, 'cost4_account_id') ?>

    <?php // echo $form->field($model, 'cost4_value') ?>

    <?php // echo $form->field($model, 'cost4_value_real') ?>

    <?php // echo $form->field($model, 'cost5_account_id') ?>

    <?php // echo $form->field($model, 'cost5_value') ?>

    <?php // echo $form->field($model, 'cost5_value_real') ?>

    <?php // echo $form->field($model, 'disc1_account_id') ?>

    <?php // echo $form->field($model, 'disc1_value') ?>

    <?php // echo $form->field($model, 'disc1_value_real') ?>

    <?php // echo $form->field($model, 'disc2_account_id') ?>

    <?php // echo $form->field($model, 'disc2_value') ?>

    <?php // echo $form->field($model, 'disc2_value_real') ?>

    <?php // echo $form->field($model, 'disc3_account_id') ?>

    <?php // echo $form->field($model, 'disc3_value') ?>

    <?php // echo $form->field($model, 'disc3_value_real') ?>

    <?php // echo $form->field($model, 'disc4_account_id') ?>

    <?php // echo $form->field($model, 'disc4_value') ?>

    <?php // echo $form->field($model, 'disc4_value_real') ?>

    <?php // echo $form->field($model, 'disc5_account_id') ?>

    <?php // echo $form->field($model, 'disc5_value') ?>

    <?php // echo $form->field($model, 'disc5_value_real') ?>

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
