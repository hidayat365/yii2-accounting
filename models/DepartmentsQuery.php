<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Departments]].
 *
 * @see Departments
 */
class DepartmentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Departments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Departments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}