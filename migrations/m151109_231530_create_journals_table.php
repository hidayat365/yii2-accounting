<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_231530_create_journals_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('journals', [
            'id' => $this->primaryKey(),
            'journal_num' => $this->string()->notNull(),
            'journal_date' => $this->integer()->defaultValue(0),
            'journal_value' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'journal_value_real' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'posted' => $this->integer()->defaultValue(0),
            'payment' => $this->integer()->defaultValue(0),
            'closing' => $this->integer()->defaultValue(0),
            'remarks' => $this->string(),
            'type_id' => $this->integer()->notNull(),
            'account_id' => $this->integer(),
            'currency_id' => $this->integer()->notNull(),
            'currency_rate1' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'currency_rate2' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'currency_reval' => $this->decimal(15,2)->notNull()->defaultValue(0),
            'reference_id' => $this->integer(),
            'reference_num' => $this->string(),
            'reference_date' => $this->integer(),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_journals_accounts',
            'journals', 'account_id',
            'accounts', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journals_types',
            'journals', 'type_id',
            'journal_types', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journals_currencies',
            'journals', 'currency_id',
            'currencies', 'id',
            'restrict', 'cascade'
        );
        $this->addForeignKey(
            'fk_journals_reference',
            'journals', 'reference_id',
            'journals', 'id',
            'restrict', 'cascade'
        );

    }

    public function safeDown()
    {
        $this->dropTable('journals');
    }
}
