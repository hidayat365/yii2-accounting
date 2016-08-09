<?php

use yii\db\Migration;

/**
 * Handles the creation for table `accounts_path_view`.
 */
class m160630_045430_create_accounts_path_view extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
          CREATE VIEW accounts_path AS
          WITH RECURSIVE q AS (
            SELECT  h, 1 AS level
            , array[]::integer[] || id AS id_breadcrumb
            , array[]::varchar[] || code AS code_breadcrumb
            , array[]::varchar[] || name AS name_breadcrumb
            FROM    accounts h
            WHERE   parent_id is null
            UNION ALL
            SELECT  hi, q.level + 1 AS level
            , id_breadcrumb || id
            , code_breadcrumb || code
            , name_breadcrumb::varchar(255)[] || name
            FROM    q
            JOIN    accounts hi
            ON      hi.parent_id = (q.h).id
          )
          SELECT  (q.h).id id
          , id_breadcrumb[1] id_level1
          , id_breadcrumb[2] id_level2
          , id_breadcrumb[3] id_level3
          , id_breadcrumb[4] id_level4
          , id_breadcrumb::varchar AS id_path
          , (q.h).code
          , code_breadcrumb[1] code_level1
          , code_breadcrumb[2] code_level2
          , code_breadcrumb[3] code_level3
          , code_breadcrumb[4] code_level4
          , code_breadcrumb::varchar AS code_path
          , REPEAT('  ', level) || (q.h).code code_indented
          , (q.h).name
          , name_breadcrumb[1] name_level1
          , name_breadcrumb[2] name_level2
          , name_breadcrumb[3] name_level3
          , name_breadcrumb[4] name_level4
          , name_breadcrumb::varchar AS name_path
          , REPEAT('  ', level) || (q.h).name name_indented
          , level, (q.h).active, (q.h).checking
          , (q.h).parent_id
          , (q.h).bank_name
          , (q.h).bank_address
          , (q.h).bank_accnum
          , (q.h).bank_accname
          , (q.h).created_by
          , (q.h).created_on
          , (q.h).modified_by
          , (q.h).modified_on
          FROM q
          ORDER BY code_breadcrumb
        ");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP VIEW accounts_path CASCADE');
    }
}
