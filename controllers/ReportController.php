<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;

use app\models\Journals;

class ReportController extends Controller
{
  private $dev_start = '2016-01-01 00:00:00';
  private $dev_date1 = '2016-01-01 00:00:00';
  private $dev_date2 = '2016-12-31 23:59:59';

  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['post'],
        ],
      ],
      'access' => [
        'class' => AccessControl::className(),
        'only' => [
          'index', 
          'balance-sheet', 
          'balance-trial', 
          'income-statement', 
          'general-ledger',
        ],
        'rules' => [
          [
            'allow' => true,
            'actions' => [
              'index', 
              'balance-sheet', 
              'balance-trial', 
              'income-statement', 
              'general-ledger',
            ],
            'roles' => ['@'],
          ],
        ],
      ],
    ];
  }

  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionBalanceSheet()
  {
    // render view
    return $this->render('balance-sheet', [
      'date1' => $this->dev_date1,
      'date2' => $this->dev_date2,
      'dataProvider' => Journals::getBalanceSheet($this->dev_start,$this->dev_date1,$this->dev_date2),
    ]);
  }

  public function actionBalanceTrial()
  {
    // render view
    return $this->render('balance-trial', [
      'date1' => $this->dev_date1,
      'date2' => $this->dev_date2,
      'dataProvider' => Journals::getTrialBalance($this->dev_start,$this->dev_date1,$this->dev_date2),
    ]);
  }

  public function actionIncomeStatement()
  {
    // render view
    return $this->render('income-statement', [
      'date1' => $this->dev_date1,
      'date2' => $this->dev_date2,
      'dataProvider' => Journals::getIncomeStatement($this->dev_start,$this->dev_date1,$this->dev_date2),
    ]);
  }

}
