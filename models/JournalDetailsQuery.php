<?php

namespace app\modules\accounting\models;

/**
 * This is the ActiveQuery class for [[JournalDetails]].
 *
 * @see JournalDetails
 */
class JournalDetailsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return JournalDetails[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JournalDetails|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}