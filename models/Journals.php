<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;
use app\models\Branches;
use app\models\Sources;
use app\models\Currencies;
use app\models\JournalTypes;
use app\models\JournalDetails;

/**
 * This is the model class for table "journals".
 *
 * @property integer $id
 * @property string $journal_num
 * @property integer $journal_date
 * @property string $journal_value
 * @property string $journal_value_real
 * @property integer $posted
 * @property integer $payment
 * @property integer $closing
 * @property string $remarks
 * @property integer $branch_id
 * @property integer $type_id
 * @property integer $account_id
 * @property integer $source_id
 * @property integer $currency_id
 * @property string $currency_rate1
 * @property string $currency_rate2
 * @property string $currency_reval
 * @property integer $reference_id
 * @property string $reference_num
 * @property integer $reference_date
 * @property integer $order_id
 * @property string $order_num
 * @property integer $order_date
 * @property integer $invoice_id
 * @property string $invoice_num
 * @property integer $invoice_date
 * @property integer $cost1_account_id
 * @property string $cost1_value
 * @property string $cost1_value_real
 * @property integer $cost2_account_id
 * @property string $cost2_value
 * @property string $cost2_value_real
 * @property integer $cost3_account_id
 * @property string $cost3_value
 * @property string $cost3_value_real
 * @property integer $cost4_account_id
 * @property string $cost4_value
 * @property string $cost4_value_real
 * @property integer $cost5_account_id
 * @property string $cost5_value
 * @property string $cost5_value_real
 * @property integer $disc1_account_id
 * @property string $disc1_value
 * @property string $disc1_value_real
 * @property integer $disc2_account_id
 * @property string $disc2_value
 * @property string $disc2_value_real
 * @property integer $disc3_account_id
 * @property string $disc3_value
 * @property string $disc3_value_real
 * @property integer $disc4_account_id
 * @property string $disc4_value
 * @property string $disc4_value_real
 * @property integer $disc5_account_id
 * @property string $disc5_value
 * @property string $disc5_value_real
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property JournalDetails[] $journalDetails
 * @property JournalDetails[] $journalDetails0
 * @property Accounts $account
 * @property Branches $branch
 * @property Currencies $currency
 * @property Journals $invoice
 * @property Journals[] $journals
 * @property Journals $reference
 * @property Journals[] $journals0
 * @property Sources $source
 * @property JournalTypes $type
 */
class Journals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_num', 'journal_date', 'branch_id', 'type_id', 'currency_id'], 'required'],
            [['journal_num'], 'unique', 'targetAttribute' => ['branch_id', 'journal_num']],
            [['journal_date', 'posted', 'payment', 'closing', 'branch_id', 'type_id', 'account_id', 'source_id', 'currency_id', 'reference_id', 'reference_date', 'order_id', 'order_date', 'invoice_id', 'invoice_date', 'cost1_account_id', 'cost2_account_id', 'cost3_account_id', 'cost4_account_id', 'cost5_account_id', 'disc1_account_id', 'disc2_account_id', 'disc3_account_id', 'disc4_account_id', 'disc5_account_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['journal_value', 'journal_value_real', 'currency_rate1', 'currency_rate2', 'currency_reval', 'cost1_value', 'cost1_value_real', 'cost2_value', 'cost2_value_real', 'cost3_value', 'cost3_value_real', 'cost4_value', 'cost4_value_real', 'cost5_value', 'cost5_value_real', 'disc1_value', 'disc1_value_real', 'disc2_value', 'disc2_value_real', 'disc3_value', 'disc3_value_real', 'disc4_value', 'disc4_value_real', 'disc5_value', 'disc5_value_real'], 'number'],
            [['journal_num', 'reference_num', 'order_num', 'invoice_num', 'remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'journal_num' => Yii::t('app', 'Journal Number'),
            'journal_date' => Yii::t('app', 'Journal Date'),
            'journal_value' => Yii::t('app', 'Journal Value'),
            'journal_value_real' => Yii::t('app', 'Journal Value'),
            'posted' => Yii::t('app', 'Posted'),
            'payment' => Yii::t('app', 'Payment'),
            'closing' => Yii::t('app', 'Closing'),
            'remarks' => Yii::t('app', 'Remarks'),
            'branch_id' => Yii::t('app', 'Branch'),
            'type_id' => Yii::t('app', 'Journal Type'),
            'account_id' => Yii::t('app', 'Account'),
            'source_id' => Yii::t('app', 'Source'),
            'currency_id' => Yii::t('app', 'Currency'),
            'currency_rate1' => Yii::t('app', 'Currency Rate'),
            'currency_rate2' => Yii::t('app', 'Currency Rate'),
            'currency_reval' => Yii::t('app', 'Currency Reval'),
            'reference_id' => Yii::t('app', 'Reference Number'),
            'reference_num' => Yii::t('app', 'Reference Number'),
            'reference_date' => Yii::t('app', 'Reference Date'),
            'order_id' => Yii::t('app', 'Order Number'),
            'order_num' => Yii::t('app', 'Order Number'),
            'order_date' => Yii::t('app', 'Order Date'),
            'invoice_id' => Yii::t('app', 'Invoice Number'),
            'invoice_num' => Yii::t('app', 'Invoice Num'),
            'invoice_date' => Yii::t('app', 'Invoice Date'),
            'cost1_account_id' => Yii::t('app', 'Cost1 Account ID'),
            'cost1_value' => Yii::t('app', 'Cost1 Value'),
            'cost1_value_real' => Yii::t('app', 'Cost1 Value Real'),
            'cost2_account_id' => Yii::t('app', 'Cost2 Account ID'),
            'cost2_value' => Yii::t('app', 'Cost2 Value'),
            'cost2_value_real' => Yii::t('app', 'Cost2 Value Real'),
            'cost3_account_id' => Yii::t('app', 'Cost3 Account ID'),
            'cost3_value' => Yii::t('app', 'Cost3 Value'),
            'cost3_value_real' => Yii::t('app', 'Cost3 Value Real'),
            'cost4_account_id' => Yii::t('app', 'Cost4 Account ID'),
            'cost4_value' => Yii::t('app', 'Cost4 Value'),
            'cost4_value_real' => Yii::t('app', 'Cost4 Value Real'),
            'cost5_account_id' => Yii::t('app', 'Cost5 Account ID'),
            'cost5_value' => Yii::t('app', 'Cost5 Value'),
            'cost5_value_real' => Yii::t('app', 'Cost5 Value Real'),
            'disc1_account_id' => Yii::t('app', 'Disc1 Account ID'),
            'disc1_value' => Yii::t('app', 'Disc1 Value'),
            'disc1_value_real' => Yii::t('app', 'Disc1 Value Real'),
            'disc2_account_id' => Yii::t('app', 'Disc2 Account ID'),
            'disc2_value' => Yii::t('app', 'Disc2 Value'),
            'disc2_value_real' => Yii::t('app', 'Disc2 Value Real'),
            'disc3_account_id' => Yii::t('app', 'Disc3 Account ID'),
            'disc3_value' => Yii::t('app', 'Disc3 Value'),
            'disc3_value_real' => Yii::t('app', 'Disc3 Value Real'),
            'disc4_account_id' => Yii::t('app', 'Disc4 Account ID'),
            'disc4_value' => Yii::t('app', 'Disc4 Value'),
            'disc4_value_real' => Yii::t('app', 'Disc4 Value Real'),
            'disc5_account_id' => Yii::t('app', 'Disc5 Account ID'),
            'disc5_value' => Yii::t('app', 'Disc5 Value'),
            'disc5_value_real' => Yii::t('app', 'Disc5 Value Real'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalDetails()
    {
        return $this->hasMany(JournalDetails::className(), ['journal_id' => 'id']);
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
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currencies::className(), ['id' => 'currency_id']);
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
    public function getInvoices()
    {
        return $this->hasMany(Journals::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReference()
    {
        return $this->hasOne(Journals::className(), ['id' => 'reference_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferences()
    {
        return $this->hasMany(Journals::className(), ['reference_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Sources::className(), ['id' => 'source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(JournalTypes::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     * @return JournalsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalsQuery(get_called_class());
    }

    /**
     * Get Trial Balance data for given period.
     * @param integer $branch
     * @param date $start
     * @param date $date1
     * @param date $date2
     * @return SqlDataProvider
     */
    public static function getTrialBalance($branch,$start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, ax.account_id
          , cs.code account_code, cs.name account_name
          , br.code branch_code, br.name branch_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(ax.begin_balance,0) acc_balance
          , coalesce(tx.tx_balance,0) tx_balance
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0)
          + coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from (
            select branch_id, account_id, begin_balance from account_balances
            where branch_id=:p0
            and iyear=extract(year from date '$start')
            and imonth=extract(month from date '$start')
          ) ax
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by branch_id, account_id
          ) tx
          on ax.account_id=tx.account_id
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by branch_id, account_id
          ) bx
          on ax.account_id=bx.account_id
          join accounts_path cs on ax.account_id=cs.id
          join branches br on ax.branch_id=br.id
          where ax.account_id not in (
            select parent_id
            from accounts
            where parent_id is not null
          )
          and (
            coalesce(ax.begin_balance,0) <>0
            or coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
              ':p0' => $branch,
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }

    /**
    * Get Balance Sheet data for given period.
    * @param integer $branch
    * @param date $start
    * @param date $date1
    * @param date $date2
     * @return SqlDataProvider
     */
    public static function getBalanceSheet($branch,$start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, ax.account_id
          , cs.code account_code, cs.name account_name
          , br.code branch_code, br.name branch_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(ax.begin_balance,0) acc_balance
          , coalesce(tx.tx_balance,0) tx_balance
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0)
          + coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from (
            select branch_id, account_id, begin_balance from account_balances
            where branch_id=:p0
            and iyear=extract(year from date '$start')
            and imonth=extract(month from date '$start')
          ) ax
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by branch_id, account_id
          ) tx
          on ax.account_id=tx.account_id
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by branch_id, account_id
          ) bx
          on ax.account_id=bx.account_id
          join accounts_path cs on ax.account_id=cs.id
          join branches br on ax.branch_id=br.id
          where ax.account_id not in (
            select parent_id
            from accounts
            where parent_id is not null
          )
          and cs.code_level1 in ('1000','2000','3000')
          and (
            coalesce(ax.begin_balance,0) <>0
            or coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          union all
          select ce.code_path, br.acc_profit1
          , ce.code account_code, ce.name account_name
          , br.code branch_code, br.name branch_name
          , ce.code_level1, ce.name_level1
          , ce.code_level2, ce.name_level2
          , ce.code_level3, ce.name_level3
          , ce.code_level4, ce.name_level4
          , sum(coalesce(ax.begin_balance,0)) acc_balance
          , sum(coalesce(tx.tx_balance,0)) tx_balance
          , sum(coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0)) begin_balance
          , sum(coalesce(bx.debet,0)) debet, sum(coalesce(bx.credit,0)) credit
          , sum(coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0)
          + coalesce(bx.debet,0) -coalesce(bx.credit,0)) end_balance
          from (
            select branch_id, account_id, begin_balance from account_balances
            where branch_id=:p0
            and iyear=extract(year from date '$start')
            and imonth=extract(month from date '$start')
          ) ax
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by branch_id, account_id
          ) tx
          on ax.account_id=tx.account_id
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by branch_id, account_id
          ) bx
          on ax.account_id=bx.account_id
          join accounts_path cs on ax.account_id=cs.id
          join branches br on ax.branch_id=br.id
          join accounts_path ce on br.acc_profit1=ce.id
          where ax.account_id not in (
            select parent_id
            from accounts
            where parent_id is not null
          )
          and cs.code_level1 not in ('1000','2000','3000')
          and (
            coalesce(ax.begin_balance,0) <>0
            or coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          group by ce.code_path, br.acc_profit1
          , ce.code, ce.name, br.code, br.name
          , ce.code_level1, ce.name_level1
          , ce.code_level2, ce.name_level2
          , ce.code_level3, ce.name_level3
          , ce.code_level4, ce.name_level4
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
              ':p0' => $branch,
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }

    /**
     * Get Income Statement data for given period.
     * @param integer $branch
     * @param date $start
     * @param date $date1
     * @param date $date2
     * @return SqlDataProvider
     */
    public static function getIncomeStatement($branch,$start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, ax.account_id
          , cs.code account_code, cs.name account_name
          , br.code branch_code, br.name branch_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(ax.begin_balance,0) acc_balance
          , coalesce(tx.tx_balance,0) tx_balance
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(ax.begin_balance,0) +coalesce(tx.tx_balance,0)
          + coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from (
            select branch_id, account_id, begin_balance from account_balances
            where branch_id=:p0
            and iyear=extract(year from date '$start')
            and imonth=extract(month from date '$start')
          ) ax
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by branch_id, account_id
          ) tx
          on ax.account_id=tx.account_id
          left join (
            select branch_id, account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where branch_id=:p0 and posted=1
            and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by branch_id, account_id
          ) bx
          on ax.account_id=bx.account_id
          join accounts_path cs on ax.account_id=cs.id
          join branches br on ax.branch_id=br.id
          where ax.account_id not in (
            select parent_id
            from accounts
            where parent_id is not null
          )
          and cs.code_level1 not in ('1000','2000','3000')
          and (
            coalesce(ax.begin_balance,0) <>0
            or coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
              ':p0' => $branch,
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }


}
