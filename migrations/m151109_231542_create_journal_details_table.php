<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_231542_create_journal_details_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('journal_details', [
            'id' => $this->primaryKey(),
            'journal_id' => $this->integer()->notNull(),
            'debet' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'debet_real' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'credit' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'credit_real' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'currency_rate1' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'currency_rate2' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'account_id' => $this->integer()->notNull(),
            'department_id' => $this->integer(),
            'project_id' => $this->integer(),
            'reference_id' => $this->integer(),
            'reference_num' => $this->string(),
            'reference_date' => $this->integer(),
            'remarks' => $this->string(),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_journal_details_accounts',
            'journal_details', 'account_id',
            'accounts', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journal_details_projects',
            'journal_details', 'project_id',
            'projects', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journal_details_departments',
            'journal_details', 'department_id',
            'departments', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journal_details_reference',
            'journal_details', 'reference_id',
            'journals', 'id',
            'restrict', 'cascade'
        );
    }

    public function safeDown()
    {
        $this->dropTable('journal_details');
    }
}
