<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;

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
    <?php if ($model->level > 2): ?>
      <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
          'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
          'method' => 'post',
        ],
      ]) ?>
    <?php endif; ?>
    <?= Html::a(Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-warning', 'title' => Yii::t('app', 'Create New')]) ?>
    <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-success']) ?>
  </p>

  <?= DetailView::widget([
    'model' => $model,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'hAlign' => DetailView::ALIGN_RIGHT,
    'vAlign' => DetailView::ALIGN_MIDDLE,
    'panel' => [
      'type' => DetailView::TYPE_INFO, 
      'heading' => '<i class="fa fa-book"></i> <strong>'.Yii::t('app','Account Information').'</strong>',
      'footer' => '<div class="text-center text-muted">'. $model->code . ': ' . $model->name .'</div>'
    ],
    'buttons1' => '',
    'buttons2' => '',
    'attributes' => [
      //'id',
      'code',
      'name',
      [
        'attribute' => 'checking',
        'format' => 'raw',
        'value' => $model->checking 
          ? '<span class="label label-success">Yes</span>' 
          : '<span class="label label-danger">No</span>',
        'labelColOptions' => [ 'style' => 'width:30%; text-align:right;' ]
      ],
      [
        'attribute' => 'active',
        'format' => 'raw',
        'value' => $model->active 
          ? '<span class="label label-success">Yes</span>' 
          : '<span class="label label-danger">No</span>',
        'labelColOptions' => [ 'style' => 'width:30%; text-align:right;' ]
      ],
      'level',
      [
        'attribute' => 'parent_id',
        'format' => 'raw',
        'value' =>  isset($model->parent) 
          ? Html::a($model->parent->name,
            Url::to(['/account/view','id' => $model->parent_id]),
            ['class' => 'kv-author-link']) 
          : "-",
        'label' => 'Parent Account'
      ],
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
