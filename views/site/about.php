<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About BiruniLabs Accounting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      BiruniLabs Accounting is a simple General Ledger Application,
      developed as a proof of concept for larger project.
      Currently only supports double entry, single entry,
      multi currency, and project and department allocation.
    </p>
    <p>
      Developed using Yii 2 Framework and PostgreSQL database.
      Currently only PostgreSQL is supported since some of the reports
      is using Common Table Expression (CTE) which MySQL does not support.
    </p>

</div>
