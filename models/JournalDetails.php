<?php

namespace app\models;

use Yii;
use app\models\Projects;
use app\models\Departments;
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
 * @property string $remarks
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property Accounts $account
 * @property Departments $department
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
    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'account_id'], 'required'],
            [['journal_id', 'account_id', 'department_id', 'project_id', 'reference_id', 'reference_date', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['debet', 'debet_real', 'credit', 'credit_real', 'currency_rate1', 'currency_rate2'], 'number'],
            [['reference_num', 'remarks'], 'string', 'max' => 255],
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
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
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
