<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Accounts;
use app\models\Journals;
use app\models\JournalTypes;
use app\models\JournalsSearch;
use app\models\JournalDetails;
use app\models\JournalDetailsSearch;
use app\models\ReceiveSearch;
use app\models\Currencies;
use app\models\Model;

/**
 * ReceiveController implements the CRUD actions for Journals model.
 */
class ReceiveController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Journals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Journals model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'details' => $this->findDetails($id),
        ]);
    }

    /**
     * Creates a new Journals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $model = new Journals();
      $details = [ new JournalDetails ];
      $accounts = Accounts::find()->all();

      $model->posted = 1;
      $model->payment = 0;
      $model->closing = 0;
      $model->type_id = JournalTypes::find()->where(['code' => 'BRV'])->one()->id;
      $model->currency_rate1 = 1;
      $model->currency_rate2 = 1;
      $model->currency_reval = 1;
      $model->currency_id = Currencies::find()->where(['code' => 'IDR'])->one()->id;

      // proses isi post variable
      if ($model->load(Yii::$app->request->post())) {
          $details = Model::createMultiple(JournalDetails::classname());
          Model::loadMultiple($details, Yii::$app->request->post());

          // assign default journal_id
          $total = 0;
          foreach ($details as $detail) {
              $detail->journal_id = 0;
              $total += $detail->credit_real;
          }

          // tambahkan summary row
          if ($model->account_id) {
            $total_row = new JournalDetails;
            $total_row->journal_id = 0;
            $total_row->account_id = $model->account_id;
            $total_row->debet = $total *$model->currency_rate1;
            $total_row->debet_real = $total;
            $total_row->credit = 0;
            $total_row->credit_real = 0;
            $total_row->remarks = $model->remarks;
            $details[] = $total_row;
          }

          // ajax validation
          if (Yii::$app->request->isAjax) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return ArrayHelper::merge(
                  ActiveForm::validateMultiple($details),
                  ActiveForm::validate($model)
              );
          }

          // hitung journal values
          $value1 = 0; $value2 = 0;
          $sum_debet = 0; $sum_credit = 0;
          foreach ($details as $detail) {
            $detail->debet = $detail->debet_real *$model->currency_rate1;
            $detail->credit = $detail->credit_real *$model->currency_rate1;
            $value1 += $detail->debet_real;
            $value2 += $detail->debet_real *$model->currency_rate1;
            $sum_debet += $detail->debet_real *$model->currency_rate1;
            $sum_credit += $detail->credit_real *$model->currency_rate1;
          }
          $model->journal_value = $value2;
          $model->journal_value_real = $value1;

          // validate all models
          $valid1 = $model->validate();
          $valid2 = Model::validateMultiple($details);
          $valid = $valid1 && $valid2 && ($sum_debet==$sum_credit) && $model->account_id;

          // jika valid, mulai proses penyimpanan
          if ($valid) {
              // mulai database journal
              $journal = \Yii::$app->db->beginTransaction();
              try {
                  // simpan master record
                  if ($flag = $model->save(false)) {
                      // simpan details record
                      foreach ($details as $detail) {
                          // modify values
                          $detail->journal_id = $model->id;
                          // simpan, rollback jika gagal
                          if (! ($flag = $detail->save(false))) {
                              $journal->rollBack();
                              break;
                          }
                      }
                  }
                  if ($flag) {
                      // sukses, commit database journal
                      // kemudian tampilkan hasilnya
                      $journal->commit();
                      return $this->redirect(['view', 'id' => $model->id]);
                  } else {
                      return $this->render('create', [
                          'model' => $model,
                          'details' => $details,
                          'accounts' => $accounts,
                      ]);
                  }
              } catch (Exception $e) {
                  // penyimpanan galga, rollback database journal
                  $journal->rollBack();
                  throw $e;
              }
          } else {
            // account_id not selected
            if (!$model->account_id) {
              $model->addError('account_id', 'Checking account required.');
            }
            // sum of debet and credit not balanced
            if ($sum_debet != $sum_credit) {
              $model->addError('remarks', 'Different Sum of Debet and Credit, please check detail transactions');
            }
            // render view
            return $this->render('create', [
                'model' => $model,
                'details' => $details,
                'accounts' => $accounts,
            ]);
          }

      } else {
          // inisialisai id
          // diperlukan untuk form master-detail
          $model->id = 0;
          // render view
          return $this->render('create', [
              'model' => $model,
              'details' => $details,
              'accounts' => $accounts,
          ]);
      }
    }

    /**
     * Updates an existing Journals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      // ambil parent record
      $model = $this->findModel($id);

      // proses post data jika ada
      if ($model->load(Yii::$app->request->post())) {

          // ambil detail record kecuali summary record
          $details = $model->getJournalDetails()->all();

          // determine deleted record
          $oldIDs = ArrayHelper::map($details, 'id', 'id');
          $details = Model::createMultiple(JournalDetails::classname(), $details);
          Model::loadMultiple($details, Yii::$app->request->post());
          $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($details, 'id', 'id')));

          // assign default journal_id
          $total = 0;
          foreach ($details as $detail) {
              $detail->journal_id = 0;
              $total += $detail->credit_real;
          }

          // tambahkan summary row
          if ($model->account_id) {
            $total_row = new JournalDetails;
            $total_row->journal_id = 0;
            $total_row->account_id = $model->account_id;
            $total_row->debet = $total *$model->currency_rate1;
            $total_row->debet_real = $total;
            $total_row->credit = 0;
            $total_row->credit_real = 0;
            $total_row->remarks = $model->remarks;
            $details[] = $total_row;
          }

          // ajax validation
          if (Yii::$app->request->isAjax) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return ArrayHelper::merge(
                  ActiveForm::validateMultiple($details),
                  ActiveForm::validate($model)
              );
          }

          // hitung journal values
          $value1 = 0; $value2 = 0;
          $sum_debet = 0; $sum_credit = 0;
          foreach ($details as $detail) {
            $detail->debet = $detail->debet_real *$model->currency_rate1;
            $detail->credit = $detail->credit_real *$model->currency_rate1;
            $value1 += $detail->debet_real;
            $value2 += $detail->debet_real *$model->currency_rate1;
            $sum_debet += $detail->debet_real *$model->currency_rate1;
            $sum_credit += $detail->credit_real *$model->currency_rate1;
          }
          $model->journal_value = $value2;
          $model->journal_value_real = $value1;

          // validate all models
          $valid1 = $model->validate();
          $valid2 = Model::validateMultiple($details);
          $valid = $valid1 && $valid2 && ($sum_debet==$sum_credit) && $model->account_id;

          // jika valid, mulai proses penyimpanan
          if ($valid) {
              // mulai database journal
              $journal = \Yii::$app->db->beginTransaction();
              try {
                  // simpan master record
                  if ($flag = $model->save(false)) {
                      // delete dahulu semua record yang ada
                      if (! empty($deletedIDs)) {
                          JournalDetails::deleteAll(['id' => $deletedIDs]);
                      }
                      // simpan details record
                      foreach ($details as $detail) {
                          // modify values
                          $detail->journal_id = $model->id;
                          // simpan, rollback jika gagal
                          if (! ($flag = $detail->save(false))) {
                              $journal->rollBack();
                              break;
                          }
                      }
                  }
                  if ($flag) {
                      // sukses, commit database journal
                      // kemudian tampilkan hasilnya
                      $journal->commit();
                      return $this->redirect(['view', 'id' => $model->id]);
                  }
              } catch (Exception $e) {
                  // penyimpanan galga, rollback database journal
                  $journal->rollBack();
                  throw $e;
              }
          } else {
            // account_id not selected
            if (!$model->account_id) {
              $model->addError('account_id', 'Checking account required.');
            }
            // sum of debet and credit not balanced
            if ($sum_debet != $sum_credit) {
              $model->addError('remarks', 'Different Sum of Debet and Credit, please check detail transactions');
            }
            // render view
            return $this->render('update', [
                'model' => $model,
                'details' => $details,
            ]);
          }
      }

      // ambil detail record kecuali summary record
      $details = $model->getJournalDetails()->where('debet_real=0')->all();
      // render view
      return $this->render('update', [
          'model' => $model,
          'details' => (empty($details)) ? [new JournalDetails] : $details,
      ]);
    }

    /**
     * Deletes an existing Journals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Journals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Journals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the JournalDetails model based on its foreign key value.
     * @param integer $id
     * @return data provider JournalDetails for GridView
     */
    protected function findDetails($id)
    {
        $detailModel = new JournalDetailsSearch();
        return $detailModel->search(['JournalDetailsSearch'=>['journal_id'=>$id]]);
    }

}
