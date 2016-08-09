<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => false,
        'condensed' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong>Departments List</strong>',
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;'.Yii::t('app', 'Create Department'), ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('app', 'Create Journal')])
            ],
            '{export}',
            '{toggleData}'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            'code',
            'name',
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'active',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            // 'parent_id',
            // 'created_by',
            // 'created_on',
            // 'modified_by',
            // 'modified_on',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
