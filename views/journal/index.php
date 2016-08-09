<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\modules\shared\models\Currencies;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\accounting\models\JournalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Journals List');
$subtitle = Yii::t('app', ' - General and Adjustment Journals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journals-index">

    <h1><?= Html::encode($this->title) ?> <small><?= Html::encode($subtitle) ?></small></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => false,
        'condensed' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i>  <strong>Journal Transactions</strong>',
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;'.Yii::t('app', 'Create Journals'), ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('app', 'Create Journal')])
            ],
            '{export}',
            '{toggleData}'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [   'attribute' => 'journal_num',
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '15%' ]
            ],
            [   'attribute' => 'journal_date',
                'format' => [ 'date', 'php: d-M-Y' ],
                'noWrap' => true,
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '15%' ]
            ],
            [
                'attribute' => 'currency_id',
                'header' => 'Currency',
                'value' => 'currency.code',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Currencies::find()->orderBy('name')->asArray()->all(), 'id', 'code'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [ 'allowClear' => true ],
                ],
                'filterInputOptions' => [ 'placeholder' => '*All*' ],
                'format'=>'raw',
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '3%' ]
            ],
            [
              //'header' => 'Journal Value',
              'attribute' => 'journal_value_real',
              'headerOptions' => [ 'class' => 'kv-align-middle kv-align-right' ],
              'contentOptions' => [ 'class' => 'kv-align-middle kv-align-right', 'width' => '15%' ],
              'format' => ['decimal', 2],
            ],
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'posted',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No',
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '3%' ]
            ],
            /*
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
            */
            [ 'attribute' => 'remarks',
              'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '30%' ]
            ],
            // 'journal_value',
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
