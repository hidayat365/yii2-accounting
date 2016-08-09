<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_021214_create_journal_types_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('journal_types', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // default data
        $this->insert('journal_types', [
            'id' => 10,
            'code' => 'GJV',
            'name' => 'General Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 11,
            'code' => 'BPV',
            'name' => 'Bank Payment Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 12,
            'code' => 'BRV',
            'name' => 'Bank Receive Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 13,
            'code' => 'CLS',
            'name' => 'Closing Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 14,
            'code' => 'INV',
            'name' => 'Inventory Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 15,
            'code' => 'JCV',
            'name' => 'Job Costing Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 16,
            'code' => 'PCD',
            'name' => 'Petty Cash Payment Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 17,
            'code' => 'PCR',
            'name' => 'Petty Cash Receive Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 18,
            'code' => 'PIJ',
            'name' => 'Purchase Invoice Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 19,
            'code' => 'PJC',
            'name' => 'Purchase Cancel Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 20,
            'code' => 'PRT',
            'name' => 'Purchase Return Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 21,
            'code' => 'PPJ',
            'name' => 'Purchase Payment Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 22,
            'code' => 'SIJ',
            'name' => 'Sales Invoice Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 23,
            'code' => 'SLC',
            'name' => 'Sales Cancel Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 24,
            'code' => 'SRT',
            'name' => 'Sales Return Journal',
        ]);
        $this->insert('journal_types', [
            'id' => 25,
            'code' => 'SPJ',
            'name' => 'Sales Payment Journal',
        ]);

    }

    public function safeDown()
    {
        $this->dropTable('journal_types');
    }
}
