<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Branches;

/* @var $this yii\web\View */
/* @var $model app\models\Accounts */

$this->title = Yii::t('app', 'View {modelClass}: ', [
    'modelClass' => 'Accounts',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'name',
            [
              'attribute'=>'checking',
              'format'=>'raw',
              'value' => $model->checking ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
              'labelColOptions' => [ 'style'=>'width:30%; text-align:right;' ]
            ],
            [
              'attribute'=>'active',
              'format'=>'raw',
              'value' => $model->active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
              'labelColOptions' => [ 'style'=>'width:30%; text-align:right;' ]
            ],
            [
              'attribute' => 'parent.name',
              'label' => 'Parent Account'
            ],
            'branch.name',
            /*
            'bank_name',
            'bank_address',
            'bank_accnum',
            'bank_accname',
            */
            'created_by',
            'created_on',
            'modified_by',
            'modified_on',
        ],
    ]) ?>

</div>
