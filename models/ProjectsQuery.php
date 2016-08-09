<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Projects]].
 *
 * @see Projects
 */
class ProjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Projects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Projects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}