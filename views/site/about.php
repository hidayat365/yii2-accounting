<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
  <h1><?= Html::encode($this->title) ?></h1>

  <div class="row">
    <div class="col-sm-7">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  <strong>About BiruniLabs Accounting</strong></h3>
        </div>
        <div class="panel-body">
          <p>
            BiruniLabs Accounting is a simple General Ledger Application,
            developed as a proof of concept for larger project.
            Currently only supports double entry for general journals,
            single entry for expenses and revenues journals,
            multi currency, and project and department allocation.
          </p>
          <p>
            Developed using Yii 2 Framework and PostgreSQL database.
            Currently only PostgreSQL is supported since some of the reports
            is using Common Table Expression (CTE) which MySQL does not support.
          </p>
          <p>
            .
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>  <strong>Contact Developer</strong></h3>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-stripped">
            <tr>
              <th>Developer</th>
              <td>Nur Hidayat</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>hidayat365@gmail.com</td>
            </tr>
            <tr>
              <th>Website</th>
              <td><a href="http://pojokprogrammer.net">pojokprogrammer.net</a></td>
            </tr>
            <tr>
              <th>Phone/WA</th>
              <td>+62 855-9910-165</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
