<?php

use yii\db\Schema;
use yii\db\Migration;

class m150505_125803_create_projects_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->decimal(15,2),
            'description' => $this->string() ,
            'location' => $this->string() ,
            'status' => $this->string() ,
            'active' => $this->integer()->defaultValue(1),
            'parent_id' => $this->integer(),
            'contract_num' => $this->string(),
            'contact_person' => $this->string(),
            'contact_phone' => $this->string(),
            'date_start_est' => $this->integer(),
            'date_finish_est' => $this->integer(),
            'date_start_actual' => $this->integer(),
            'date_finish_actual' => $this->integer(),
            'progress_pct' => $this->decimal(5,2),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_projects_parent',
            'projects', 'parent_id',
            'projects', 'id',
            'restrict', 'cascade'
        );
    }

    public function safeDown()
    {
        $this->dropTable('projects');
    }
}
