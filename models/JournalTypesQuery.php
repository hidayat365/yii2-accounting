<?php

namespace app\modules\accounting\models;

/**
 * This is the ActiveQuery class for [[JournalTypes]].
 *
 * @see JournalTypes
 */
class JournalTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return JournalTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JournalTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}