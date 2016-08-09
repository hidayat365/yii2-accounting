<?php

namespace app\modules\accounting\models;

/**
 * This is the ActiveQuery class for [[Accounts]].
 *
 * @see Accounts
 */
class AccountsQuery extends \yii\db\ActiveQuery
{
  public function active()
  {
      $this->andWhere('[[active]]=1');
      return $this;
  }

  public function checking()
  {
      $this->andWhere('[[checking]]=1');
      return $this;
  }

  /**
   * @inheritdoc
   * @return Accounts[]|array
   */
  public function all($db = null)
  {
      return parent::all($db);
  }

  /**
   * @inheritdoc
   * @return Accounts|array|null
   */
  public function one($db = null)
  {
      return parent::one($db);
  }
}
