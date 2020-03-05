<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;
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
 * @property integer $type_id
 * @property integer $account_id
 * @property integer $currency_id
 * @property string $currency_rate1
 * @property string $currency_rate2
 * @property string $currency_reval
 * @property integer $reference_id
 * @property string $reference_num
 * @property integer $reference_date
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property JournalDetails[] $journalDetails
 * @property Accounts $account
 * @property Currencies $currency
 * @property Journals[] $journals
 * @property Journals $reference
 * @property JournalTypes $type
 */
class Journals extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;

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
            [['journal_num', 'journal_date', 'type_id', 'currency_id'], 'required'],
            [['journal_num'], 'unique', 'targetAttribute' => ['journal_num']],
            [['journal_date', 'posted', 'payment', 'closing', 'type_id', 'account_id', 'currency_id', 'reference_id', 'reference_date', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['journal_value', 'journal_value_real', 'currency_rate1', 'currency_rate2', 'currency_reval'], 'number'],
            [['journal_num', 'reference_num', 'remarks'], 'string', 'max' => 255]
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
            'type_id' => Yii::t('app', 'Journal Type'),
            'account_id' => Yii::t('app', 'Account'),
            'currency_id' => Yii::t('app', 'Currency'),
            'currency_rate1' => Yii::t('app', 'Currency Rate'),
            'currency_rate2' => Yii::t('app', 'Currency Rate'),
            'currency_reval' => Yii::t('app', 'Currency Reval'),
            'reference_id' => Yii::t('app', 'Reference Number'),
            'reference_num' => Yii::t('app', 'Reference Number'),
            'reference_date' => Yii::t('app', 'Reference Date'),
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
    public function getCurrency()
    {
        return $this->hasOne(Currencies::className(), ['id' => 'currency_id']);
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
     * @param date $start
     * @param date $date1
     * @param date $date2
     * @return SqlDataProvider
     */
    public static function getTrialBalance($start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, cs.id account_id
          , cs.code account_code, cs.name account_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(tx.tx_balance,0) +coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from accounts_path cs
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by account_id
          ) tx on cs.id = tx.account_id
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by account_id
          ) bx on cs.id = bx.account_id
          where cs.id not in (
            select parent_id from accounts
            where parent_id is not null
          )
          and (
            coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }

    /**
    * Get Balance Sheet data for given period.
    * @param date $start
    * @param date $date1
    * @param date $date2
     * @return SqlDataProvider
     */
    public static function getBalanceSheet($start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, cs.id account_id
          , cs.code account_code, cs.name account_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(tx.tx_balance,0) +coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from accounts_path cs
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by account_id
          ) tx on cs.id = tx.account_id
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by account_id
          ) bx on cs.id = bx.account_id
          where cs.id not in (
            select parent_id from accounts
            where parent_id is not null
          )
          and (
            coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          and cs.code_level1 in ('1000','2000','3000')
          union all
          select cs.code_path, 3220 acc_profit1
          , cs.code account_code, cs.name account_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , sum(coalesce(tx.tx_balance,0)) begin_balance
          , sum(coalesce(bx.debet,0)) debet, sum(coalesce(bx.credit,0)) credit
          , sum(coalesce(tx.tx_balance,0) +coalesce(bx.debet,0) -coalesce(bx.credit,0)) end_balance
          from accounts_path cs
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by account_id
          ) tx on cs.id = tx.account_id
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by account_id
          ) bx on cs.id = bx.account_id
          where cs.id not in (
            select parent_id from accounts
            where parent_id is not null
          )
          and (
            coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          and cs.code_level1 not in ('1000','2000','3000')
          group by cs.code_path
          , cs.code, cs.name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }

    /**
     * Get Income Statement data for given period.
     * @param date $start
     * @param date $date1
     * @param date $date2
     * @return SqlDataProvider
     */
    public static function getIncomeStatement($start,$date1,$date2)
    {
        // query kartu stok
        $sql_list = "
          select cs.code_path, cs.id account_id
          , cs.code account_code, cs.name account_name
          , cs.code_level1, cs.name_level1
          , cs.code_level2, cs.name_level2
          , cs.code_level3, cs.name_level3
          , cs.code_level4, cs.name_level4
          , coalesce(tx.tx_balance,0) begin_balance
          , coalesce(bx.debet,0) debet, coalesce(bx.credit,0) credit
          , coalesce(tx.tx_balance,0) +coalesce(bx.debet,0) -coalesce(bx.credit,0) end_balance
          from accounts_path cs
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2)
            - round(sum(coalesce(credit,0)),2) tx_balance
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$start')
            and extract(epoch from date '$date1')-1
            group by account_id
          ) tx on cs.id = tx.account_id
          left join (
            select account_id
            , round(sum(coalesce(debet,0)),2) debet
            , round(sum(coalesce(credit,0)),2) credit
            from journal_denormalized2
            where posted=1 and journal_date
            between extract(epoch from date '$date1')
            and extract(epoch from date '$date2')
            group by account_id
          ) bx on cs.id = bx.account_id
          where cs.id not in (
            select parent_id from accounts
            where parent_id is not null
          )
          and (
            coalesce(tx.tx_balance,0) <>0
            or coalesce(bx.debet,0) <>0
            or coalesce(bx.credit,0) <>0
          )
          and cs.code_level1 not in ('1000','2000','3000')
          order by code_path
        ";
        // data provider untuk ditampilkan di view
        return $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [
            ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }


}
