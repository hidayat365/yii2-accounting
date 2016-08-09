<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Departments */

$this->title = Yii::t('app', 'Create Departments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
