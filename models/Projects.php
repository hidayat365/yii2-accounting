<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $value
 * @property string $description
 * @property string $location
 * @property integer $active
 * @property integer $branch_id
 * @property integer $parent_id
 * @property integer $manager_id
 * @property string $contract_num
 * @property string $contact_person
 * @property string $contact_phone
 * @property string $date_start_est
 * @property string $date_finish_est
 * @property string $date_start_actual
 * @property string $date_finish_actual
 * @property string $status
 * @property string $progress_pct
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property Branches $branch
 * @property Projects $parent
 * @property Projects[] $projects
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'branch_id'], 'required'],
            [['value', 'progress_pct'], 'number'],
            [['active', 'branch_id', 'parent_id', 'manager_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['date_start_est', 'date_finish_est', 'date_start_actual', 'date_finish_actual'], 'safe'],
            [['code', 'name', 'description', 'location', 'contract_num', 'contact_person', 'contact_phone', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Project'),
            'code' => Yii::t('app', 'Project Code'),
            'name' => Yii::t('app', 'Project Name'),
            'value' => Yii::t('app', 'Project Value'),
            'description' => Yii::t('app', 'Description'),
            'location' => Yii::t('app', 'Location'),
            'active' => Yii::t('app', 'Active'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'parent_id' => Yii::t('app', 'Sub Project of'),
            'manager_id' => Yii::t('app', 'Project Manager'),
            'contract_num' => Yii::t('app', 'Contract Num'),
            'contact_person' => Yii::t('app', 'Contact Person'),
            'contact_phone' => Yii::t('app', 'Contact Phone'),
            'date_start_est' => Yii::t('app', 'Date Start Est'),
            'date_finish_est' => Yii::t('app', 'Date Finish Est'),
            'date_start_actual' => Yii::t('app', 'Date Start Actual'),
            'date_finish_actual' => Yii::t('app', 'Date Finish Actual'),
            'status' => Yii::t('app', 'Status'),
            'progress_pct' => Yii::t('app', 'Progress Pct'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
        ];
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
        return $this->hasOne(Projects::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectsQuery(get_called_class());
    }
}
