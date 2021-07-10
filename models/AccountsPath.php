<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accounts_path".
 *
 * @property integer $id
 * @property integer $id_level1
 * @property integer $id_level2
 * @property integer $id_level3
 * @property integer $id_level4
 * @property string $id_path
 * @property string $code
 * @property string $code_level1
 * @property string $code_level2
 * @property string $code_level3
 * @property string $code_level4
 * @property string $code_path
 * @property string $code_indented
 * @property string $name
 * @property string $name_level1
 * @property string $name_level2
 * @property string $name_level3
 * @property string $name_level4
 * @property string $name_path
 * @property string $name_indented
 * @property integer $level
 * @property integer $active
 * @property integer $checking
 * @property integer $parent_id
 * @property string $bank_name
 * @property string $bank_address
 * @property string $bank_accnum
 * @property string $bank_accname
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $modified_by
 * @property integer $modified_on
 */
class AccountsPath extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts_path';
    }

    /**
     * @inheritdoc$primaryKey
     */
    public static function primaryKey()
    {
        return ["id"];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_level1', 'id_level2', 'id_level3', 'id_level4', 'level', 'active', 'checking', 'parent_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['id_path', 'code_level1', 'code_level2', 'code_level3', 'code_level4', 'code_path', 'code_indented', 'name_level1', 'name_level2', 'name_level3', 'name_level4', 'name_path', 'name_indented'], 'string'],
            [['code', 'name', 'bank_name', 'bank_address', 'bank_accnum', 'bank_accname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_level1' => Yii::t('app', 'Id Level1'),
            'id_level2' => Yii::t('app', 'Id Level2'),
            'id_level3' => Yii::t('app', 'Id Level3'),
            'id_level4' => Yii::t('app', 'Id Level4'),
            'id_path' => Yii::t('app', 'Id Path'),
            'code' => Yii::t('app', 'Code'),
            'code_level1' => Yii::t('app', 'Code Level1'),
            'code_level2' => Yii::t('app', 'Code Level2'),
            'code_level3' => Yii::t('app', 'Code Level3'),
            'code_level4' => Yii::t('app', 'Code Level4'),
            'code_path' => Yii::t('app', 'Code Path'),
            'code_indented' => Yii::t('app', 'Code Indented'),
            'name' => Yii::t('app', 'Name'),
            'name_level1' => Yii::t('app', 'Name Level1'),
            'name_level2' => Yii::t('app', 'Name Level2'),
            'name_level3' => Yii::t('app', 'Name Level3'),
            'name_level4' => Yii::t('app', 'Name Level4'),
            'name_path' => Yii::t('app', 'Name Path'),
            'name_indented' => Yii::t('app', 'Name Indented'),
            'level' => Yii::t('app', 'Level'),
            'active' => Yii::t('app', 'Active'),
            'checking' => Yii::t('app', 'Checking'),
            'parent_id' => Yii::t('app', 'Parent ID'),
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
    public function getParent()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'parent_id']);
    }

    /**
     * @inheritdoc
     * @return AccountsPathQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountsPathQuery(get_called_class());
    }
}
