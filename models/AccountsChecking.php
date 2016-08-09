<?php

namespace app\models;

use Yii;

class AccountsChecking extends Accounts
{
  public static function find()
  {
    return parent::find()->checking()->orderBy('code');
  }
}
