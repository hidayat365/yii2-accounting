<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal_types".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 *
 * @property Journals[] $journals
 */
class JournalTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['active', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Type ID'),
            'code' => Yii::t('app', 'Type Code'),
            'name' => Yii::t('app', 'Type Name'),
            'active' => Yii::t('app', 'Active'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journals::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JournalTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JournalTypesQuery(get_called_class());
    }
}
