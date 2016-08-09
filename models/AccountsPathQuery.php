<?php

namespace app\modules\accounting\models;

/**
 * This is the ActiveQuery class for [[AccountsPath]].
 *
 * @see AccountsPath
 */
class AccountsPathQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AccountsPath[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AccountsPath|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
