<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\models\Accounts;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;

// ambil list jenis transaksi untuk filtering
$typeList = ArrayHelper::map(Accounts::find()->asArray()->all(), 'id', 'name');

?>
<div class="accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => false,
        'condensed' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong>Chart of Accounts</strong>',
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;'.Yii::t('app', 'Create Account'), ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('app', 'Create Journal')])
            ],
            '{export}',
            '{toggleData}'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'code',
            'name',
            [   'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'checking',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            [   'class' => '\kartik\grid\BooleanColumn',
                'attribute' => 'active',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No'
            ],
            [   'attribute' => 'parent_id',
                'filter' => $typeList,
                'label' => 'Parent Account',
                'value' => function ($model, $index, $widget) { return $model->parent==null ? "" : $model->parent->name; }
            ],
            // 'bank_name',
            // 'bank_address',
            // 'bank_accnum',
            // 'bank_accname',
            // 'created_by',
            // 'created_on',
            // 'modified_by',
            // 'modified_on',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
