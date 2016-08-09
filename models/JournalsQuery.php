<?php

namespace app\modules\accounting\models;

/**
 * This is the ActiveQuery class for [[Journals]].
 *
 * @see Journals
 */
class JournalsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Journals[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Journals|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}