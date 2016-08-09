<?php

use yii\db\Migration;

/**
 * Handles the creation for table `journal_denormalized_view`.
 */
class m160629_093144_create_journal_denormalized_view extends Migration
{
  /**
   * @inheritdoc
   */
  public function up()
  {
    /**
     * journals denormalized
     * includes all (left) joins
     */
    $this->execute('
      create view journal_denormalized1 as
      select a.id, b.id detail_id, a.journal_num
      , a.journal_date, a.journal_value, a.journal_value_real
      , a.posted, a.payment, a.closing, a.remarks, b.remarks detail_remarks
      , a.type_id, t.code type_code, t.name type_name
      , a.currency_id, cr.code currency_code, cr.name currency_name
      , a.currency_rate1, a.currency_rate2
      , a.reference_id, a.reference_num, a.reference_date
      , b.department_id, dp.code department_code, dp.name department_name
      , b.project_id, pr.code project_code, pr.name project_name
      , b.account_id, b.debet, b.debet_real, b.credit, b.credit_real
      from journals as a
      join journal_details as b on a.id = b.journal_id
      join journal_types as t on a.type_id = t.id
      left join projects pr on b.project_id = pr.id
      left join departments dp on b.department_id = dp.id
      left join currencies cr on a.currency_id = cr.id
    ');
    /**
     * journals denormalized
     * includes all (left) joins
     */
    $this->execute('
      create view journal_denormalized2 as
      select a.id, b.id detail_id, a.journal_num
      , a.journal_date, a.journal_value, a.journal_value_real
      , a.posted, a.payment, a.closing, a.remarks, b.remarks detail_remarks
      , a.type_id, a.currency_id, a.currency_rate1, a.currency_rate2
      , a.reference_id, a.reference_num, a.reference_date
      , b.department_id, b.project_id, b.account_id
      , b.debet, b.debet_real, b.credit, b.credit_real
      from journals as a
      join journal_details as b on a.id = b.journal_id
    ');
  }

  /**
   * @inheritdoc
   */
  public function down()
  {
    $this->execute('drop view journal_denormalized1');
    $this->execute('drop view journal_denormalized2');
  }
}
