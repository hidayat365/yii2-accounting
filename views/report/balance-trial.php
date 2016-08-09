<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Trial Balance');
$tanggal1 = date_format(new DateTime($date1), 'd M Y');
$tanggal2 = date_format(new DateTime($date2), 'd M Y');

?>

<h1><?= $this->title ?> <small> - <?= $tanggal1 ?> to <?= $tanggal2 ?></small></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showPageSummary' => true,
    'condensed' => true,
    'panel' => [
        'type' => GridView::TYPE_SUCCESS,
        'heading' => '<i class="glyphicon glyphicon-book"></i>  <strong>Trial Balance</strong>',
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'name_level1',
            'vAlign' => 'middle',
            'group' => true,                         // enable grouping,
            'groupedRow' => true,                    // move grouped column to a single grouped row
            'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[0,1,2,3]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        2=>'Summary',
                        4=>GridView::F_SUM,
                        5=>GridView::F_SUM,
                        6=>GridView::F_SUM,
                        7=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        4=>['format'=>'number', 'decimals'=>2],
                        5=>['format'=>'number', 'decimals'=>2],
                        6=>['format'=>'number', 'decimals'=>2],
                        7=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        1=>['style'=>'font-variant:small-caps'],
                        4=>['style'=>'text-align:right'],
                        5=>['style'=>'text-align:right'],
                        6=>['style'=>'text-align:right'],
                        7=>['style'=>'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'info','style'=>'font-weight:bold;']
                ];
            }
        ],
        [
            'attribute' => 'account_code',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'account_name',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'begin_balance',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
        [
            'attribute' => 'debet',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
        [
            'attribute' => 'credit',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
        [
            'attribute' => 'end_balance',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
    ],
]); ?>
