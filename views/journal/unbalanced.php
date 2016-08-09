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
            // 'branch_id',
            // 'type_id',
            // 'account_id',
            // 'source_id',
            // 'currency_id',
            // 'currency_rate1',
            // 'currency_rate2',
            // 'currency_reval',
            // 'reference_id',
            // 'reference_num',
            // 'reference_date',
            // 'order_id',
            // 'order_num',
            // 'order_date',
            // 'invoice_id',
            // 'invoice_num',
            // 'invoice_date',
            // 'cost1_account_id',
            // 'cost1_value',
            // 'cost1_value_real',
            // 'cost2_account_id',
            // 'cost2_value',
            // 'cost2_value_real',
            // 'cost3_account_id',
            // 'cost3_value',
            // 'cost3_value_real',
            // 'cost4_account_id',
            // 'cost4_value',
            // 'cost4_value_real',
            // 'cost5_account_id',
            // 'cost5_value',
            // 'cost5_value_real',
            // 'disc1_account_id',
            // 'disc1_value',
            // 'disc1_value_real',
            // 'disc2_account_id',
            // 'disc2_value',
            // 'disc2_value_real',
            // 'disc3_account_id',
            // 'disc3_value',
            // 'disc3_value_real',
            // 'disc4_account_id',
            // 'disc4_value',
            // 'disc4_value_real',
            // 'disc5_account_id',
            // 'disc5_value',
            // 'disc5_value_real',
            // 'created_by',
            // 'created_on',
            // 'modified_by',
            // 'modified_on',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
