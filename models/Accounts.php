<?php

namespace app\modules\accounting\models;

use Yii;
use app\modules\shared\models\Branches;

/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $checking
 * @property integer $active
 * @property integer $branch_id
 * @property integer $parent_id
 * @property string $bank_name
 * @property string $bank_address
 * @property string $bank_accnum
 * @property string $bank_accname
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property AccountBalances[] $accountBalances
 * @property AccountBudgets[] $accountBudgets
 * @property Branches $branch
 * @property Accounts $parent
 * @property Accounts[] $accounts
 * @property JournalDetails[] $journalDetails
 * @property Journals[] $journals
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'branch_id'], 'required'],
            [['checking', 'active', 'branch_id', 'parent_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['code', 'name', 'bank_name', 'bank_address', 'bank_accnum', 'bank_accname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Account ID'),
            'code' => Yii::t('app', 'Account Code'),
            'name' => Yii::t('app', 'Account Name'),
            'checking' => Yii::t('app', 'Checking'),
            'active' => Yii::t('app', 'Active'),
            'branch_id' => Yii::t('app', 'Branch'),
            'parent_id' => Yii::t('app', 'Parent'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'bank_address' => Yii::t('app', 'Bank Address'),
            'bank_accnum' => Yii::t('app', 'Bank Accnum'),
            'bank_accname' => Yii::t('app', 'Bank Accname'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBalances()
    {
        return $this->hasMany(AccountBalances::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBudgets()
    {
        return $this->hasMany(AccountBudgets::className(), ['account_id' => 'id']);
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
    public function getParent()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Accounts::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalDetails()
    {
        return $this->hasMany(JournalDetails::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journals::className(), ['account_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountsQuery(get_called_class());
    }
}
