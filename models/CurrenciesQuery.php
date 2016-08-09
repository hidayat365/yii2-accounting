<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Currencies]].
 *
 * @see Currencies
 */
class CurrenciesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Currencies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Currencies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}