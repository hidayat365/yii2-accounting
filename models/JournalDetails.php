<?php

namespace app\modules\accounting\models;

use Yii;
use app\modules\shared\models\Projects;
use app\modules\shared\models\Departments;
use app\modules\inventory\models\Items;
use app\modules\inventory\models\UnitMeasures;


/**
 * This is the model class for table "journal_details".
 *
 * @property integer $id
 * @property integer $journal_id
 * @property string $debet
 * @property string $debet_real
 * @property string $credit
 * @property string $credit_real
 * @property string $currency_rate1
 * @property string $currency_rate2
 * @property integer $account_id
 * @property integer $department_id
 * @property integer $project_id
 * @property integer $reference_id
 * @property string $reference_num
 * @property integer $reference_date
 * @property integer $order_id
 * @property string $order_num
 * @property integer $order_date
 * @property integer $invoice_id
 * @property string $invoice_num
 * @property integer $invoice_date
 * @property integer $item_id
 * @property string $quantity
 * @property string $unit_price
 * @property string $tax1_pct
 * @property string $tax2_pct
 * @property string $disc1_pct
 * @property string $disc2_pct
 * @property string $remarks
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property Accounts $account
 * @property Departments $department
 * @property Journals $invoice
 * @property Projects $project
 * @property Journals $reference
 */
class JournalDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_details';
    }

    /**
     * @inheritdoc
     */
    public function init() {
      //$this->debet = 0;
      //$this->debet_real = 0;
      //$this->credit = 0;
      //$this->credit_real = 0;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'account_id'], 'required'],
            [['journal_id', 'account_id', 'department_id', 'project_id', 'reference_id', 'reference_date', 'order_id', 'order_date', 'invoice_id', 'invoice_date', 'item_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['debet', 'debet_real', 'credit', 'credit_real', 'currency_rate1', 'currency_rate2', 'quantity', 'unit_price', 'tax1_pct', 'tax2_pct', 'disc1_pct', 'disc2_pct'], 'number'],
            [['reference_num', 'order_num', 'invoice_num', 'remarks'], 'string', 'max' => 255],
            [['debet','debet_real','credit','credit_real'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'debet' => Yii::t('app', 'Debet'),
            'debet_real' => Yii::t('app', 'Debet Real'),
            'credit' => Yii::t('app', 'Credit'),
            'credit_real' => Yii::t('app', 'Credit Real'),
            'currency_rate1' => Yii::t('app', 'Currency Rate1'),
            'currency_rate2' => Yii::t('app', 'Currency Rate2'),
            'account_id' => Yii::t('app', 'Account ID'),
            'department_id' => Yii::t('app', 'Department ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'reference_id' => Yii::t('app', 'Reference ID'),
            'reference_num' => Yii::t('app', 'Reference Num'),
            'reference_date' => Yii::t('app', 'Reference Date'),
            'order_id' => Yii::t('app', 'Order ID'),
            'order_num' => Yii::t('app', 'Order Num'),
            'order_date' => Yii::t('app', 'Order Date'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'invoice_num' => Yii::t('app', 'Invoice Num'),
            'invoice_date' => Yii::t('app', 'Invoice Date'),
            'item_id' => Yii::t('app', 'Item ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'tax1_pct' => Yii::t('app', 'Tax1 Pct'),
            'tax2_pct' => Yii::t('app', 'Tax2 Pct'),
            'disc1_pct' => Yii::t('app', 'Disc1 Pct'),
            'disc2_pct' => Yii::t('app', 'Disc2 Pct'),
            'remarks' => Yii::t('app', 'Remarks'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Journals::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReference()
    {
        return $this->hasOne(Journals::className(), ['id' => 'reference_id']);
    }

    /**
     * @inheritdoc
     * @return JournalDetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalDetailsQuery(get_called_class());
    }
}
