<?php

use yii\db\Schema;
use yii\db\Migration;

class m150505_125813_create_departments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('departments', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'parent_id' => $this->integer(),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_departments_parent',
            'departments', 'parent_id',
            'departments', 'id',
            'restrict', 'cascade'
        );
    }

    public function safeDown()
    {
        $this->dropTable('departments');
    }
}
