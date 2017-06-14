<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

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
        'attributes' => [
            // 'id',
            'code',
            'name',
            'parent.name',
            [   'attribute' => 'value',
                'format' => ['decimal', 2],
            ],
            // 'description',
            'location',
            [
              'attribute'=>'active',
              'format'=>'raw',
              'value' => $model->active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
              'labelColOptions' => [ 'style'=>'width:30%; text-align:right;' ]
            ],
            // 'status',
            // 'contract_num',
            // 'contact_person',
            // 'contact_phone',
            // 'date_start_est',
            // 'date_finish_est',
            // 'date_start_actual',
            // 'date_finish_actual',
            // 'progress_pct',
            'created_by',
            'created_on',
            'modified_by',
            'modified_on',
        ],
    ]) ?>

</div>
