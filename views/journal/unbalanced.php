<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JournalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unbalanced Journals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'journal_num',
            'journal_date',
            'journal_value',
            'journal_value_real',

            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'posted',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'payment',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'closing',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            // 'type_id',
            // 'account_id',
            // 'currency_id',
            // 'currency_rate1',
            // 'currency_rate2',
            // 'currency_reval',
            // 'reference_id',
            // 'reference_num',
            // 'reference_date',
            // 'created_by',
            // 'created_on',
            // 'modified_by',
            // 'modified_on',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
