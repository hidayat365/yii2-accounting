<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Journals */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Expense',
]) . ' ' . $model->journal_num;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->journal_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="journals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'details' => $details,
    ]) ?>

</div>
