<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_021305_create_currencies_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('currencies', [
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
        $this->insert('currencies', [
            'id' => 10,
            'code' => 'IDR',
            'name' => 'Indonesia Rupiah',
        ]);
        $this->insert('currencies', [
            'id' => 12,
            'code' => 'USD',
            'name' => 'United States Dollar',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('currencies');
    }
}
