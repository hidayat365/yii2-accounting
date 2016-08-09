<?php

namespace app\modules\accounting\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use app\modules\accounting\models\Accounts;
use app\modules\accounting\models\Journals;
use app\modules\accounting\models\JournalTypes;
use app\modules\accounting\models\JournalsSearch;
use app\modules\accounting\models\JournalDetails;
use app\modules\accounting\models\JournalDetailsSearch;
use app\modules\shared\models\Currencies;

use app\models\Model;

/**
 * JournalController implements the CRUD actions for Journals model.
 */
class JournalController extends Controller
{
    // properties
    private $details = array();

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
        $searchModel = new JournalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Unbalanced Journals.
     * @return mixed
     */
    public function actionUnbalanced()
    {
        $searchModel = new JournalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('unbalanced', [
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

        $model->branch_id = 1;
        $model->posted = 1;
        $model->payment = 0;
        $model->closing = 0;
        $model->type_id = JournalTypes::find()->where(['code' => 'GJV'])->one()->id;;
        $model->currency_rate1 = 1;
        $model->currency_rate2 = 1;
        $model->currency_reval = 1;
        $model->currency_id = Currencies::find()->where(['branch_id' => $model->branch_id, 'code' => 'IDR'])->one()->id;

        // proses isi post variable
        if ($model->load(Yii::$app->request->post())) {
            $details = Model::createMultiple(JournalDetails::classname());
            Model::loadMultiple($details, Yii::$app->request->post());

            // assign default journal_id
            foreach ($details as $detail) {
                $detail->journal_id = 0;
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
            $valid = $valid1 && $valid2 && ($sum_debet==$sum_credit);

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
                if ($sum_debet != $sum_credit) {
                  $model->addError('remarks', 'Different Sum of Debet and Credit, please chech detail transactions');
                }
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
        $model = $this->findModel($id);
        $details = $model->journalDetails;
        $accounts = Accounts::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($details, 'id', 'id');
            $details = Model::createMultiple(JournalDetails::classname(), $details);
            Model::loadMultiple($details, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($details, 'id', 'id')));

            // assign default journal_id
            foreach ($details as $detail) {
                $detail->journal_id = $model->id;
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
            $valid = $valid1 && $valid2 && ($sum_debet==$sum_credit);

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
              if ($sum_debet != $sum_credit) {
                $model->addError('remarks', 'Different Sum of Debet and Credit, please chech detail transactions');
              }
              return $this->render('update', [
                  'model' => $model,
                  'details' => $details,
                  'accounts' => $accounts,
              ]);
            }
        }

        // render view
        return $this->render('update', [
            'model' => $model,
            'details' => (empty($details)) ? [new JournalDetails] : $details,
            'accounts' => $accounts,
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
        $model = $this->findModel($id);
        $details = $model->journalDetails;

        // mulai database journal
        $journal = \Yii::$app->db->beginJournal();
        try {
            // pertama, delete semua detail records
            foreach ($details as $detail) {
                $detail->delete();
            }
            // kemudian, delete master record
            $model->delete();
            // sukses, commit journal
            $journal->commit();

        } catch (Exception $e) {
            // gagal, rollback database journal
            $journal->rollBack();
        }

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
