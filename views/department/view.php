<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-view">

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
        <?= Html::a(Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-warning', 'title'=>Yii::t('app', 'Create New')]) ?>
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
            'heading' => '<i class="fa fa-book"></i> <strong>'.Yii::t('app', 'Department Information').'</strong>',
            'footer' => '<div class="text-center text-muted">'. $model->code . ': ' . $model->name .'</div>'
        ],
        'buttons1' => '',
        'buttons2' => '',
        'attributes' => [
            'code',
            'name',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'value' => $model->active 
                    ? '<span class="label label-success">Yes</span>' 
                    : '<span class="label label-danger">No</span>',
                    'labelColOptions' => [ 'style'=>'width:20%; text-align:right;' ],
                    'valueColOptions' => [ 'style'=>'width:80%' ],
            ],
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' =>  isset($model->parent) 
                    ? Html::a($model->parent->name,
                        Url::to(['/department/view','id' => $model->parent_id]),
                        ['class' => 'kv-author-link']) 
                    : "-",
                'label' => 'Parent Department'
            ],
            'created_by',
            'created_on',
            'modified_by',
            'modified_on',
        ],
    ]) ?>

</div>
