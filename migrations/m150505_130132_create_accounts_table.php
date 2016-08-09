<?php

use yii\db\Schema;
use yii\db\Migration;

class m150505_130132_create_accounts_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('accounts', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'checking' => $this->integer()->defaultValue(0),
            'active' => $this->integer()->defaultValue(1),
            'parent_id' => $this->integer(),
            'bank_name' => $this->string(),
            'bank_address' => $this->string(),
            'bank_accnum' => $this->string(),
            'bank_accname' => $this->string(),
            'created_by' => $this->integer(),
            'created_on' => $this->integer(),
            'modified_by' => $this->integer(),
            'modified_on' => $this->integer(),
        ]);

        // foreign keys
        $this->addForeignKey(
            'fk_accounts_parent',
            'accounts', 'parent_id',
            'accounts', 'id',
            'restrict', 'cascade'
        );

        // default data
        $this->insert('accounts', [ 'id'=>1000, 'code'=>'1000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Assets' ]);
        $this->insert('accounts', [ 'id'=>1100, 'code'=>'1100', 'parent_id'=>1000, 'active'=>1, 'checking'=>0, 'name'=>'Current Assets' ]);
        $this->insert('accounts', [ 'id'=>1110, 'code'=>'1110', 'parent_id'=>1100, 'active'=>1, 'checking'=>1, 'name'=>'Petty Cash' ]);
        $this->insert('accounts', [ 'id'=>1120, 'code'=>'1120', 'parent_id'=>1100, 'active'=>1, 'checking'=>1, 'name'=>'Savings Account' ]);
        $this->insert('accounts', [ 'id'=>1130, 'code'=>'1130', 'parent_id'=>1100, 'active'=>1, 'checking'=>1, 'name'=>'Deposits Account' ]);
        $this->insert('accounts', [ 'id'=>1140, 'code'=>'1140', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Investment Account' ]);
        $this->insert('accounts', [ 'id'=>1150, 'code'=>'1150', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Accounts Receivables' ]);
        $this->insert('accounts', [ 'id'=>1160, 'code'=>'1160', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Employee Advances' ]);
        $this->insert('accounts', [ 'id'=>1170, 'code'=>'1170', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Tax Receivables' ]);
        $this->insert('accounts', [ 'id'=>1180, 'code'=>'1180', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Prepaid Expense' ]);
        $this->insert('accounts', [ 'id'=>1190, 'code'=>'1190', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Inventory' ]);
        $this->insert('accounts', [ 'id'=>1199, 'code'=>'1199', 'parent_id'=>1100, 'active'=>1, 'checking'=>0, 'name'=>'Other Assets' ]);
        $this->insert('accounts', [ 'id'=>1200, 'code'=>'1200', 'parent_id'=>1000, 'active'=>1, 'checking'=>0, 'name'=>'Fixed Assets' ]);
        $this->insert('accounts', [ 'id'=>1210, 'code'=>'1210', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Furnitures' ]);
        $this->insert('accounts', [ 'id'=>1220, 'code'=>'1220', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Equipments' ]);
        $this->insert('accounts', [ 'id'=>1230, 'code'=>'1230', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Vehicles' ]);
        $this->insert('accounts', [ 'id'=>1240, 'code'=>'1240', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Lands' ]);
        $this->insert('accounts', [ 'id'=>1250, 'code'=>'1250', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Buildings' ]);
        $this->insert('accounts', [ 'id'=>1310, 'code'=>'1310', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Accumulated Depreciation, Furnitures' ]);
        $this->insert('accounts', [ 'id'=>1320, 'code'=>'1320', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Accumulated Depreciation, Equipments' ]);
        $this->insert('accounts', [ 'id'=>1330, 'code'=>'1330', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Accumulated Depreciation, Vehicles' ]);
        $this->insert('accounts', [ 'id'=>1340, 'code'=>'1340', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Accumulated Depreciation, Lands' ]);
        $this->insert('accounts', [ 'id'=>1350, 'code'=>'1350', 'parent_id'=>1200, 'active'=>1, 'checking'=>0, 'name'=>'Accumulated Depreciation, Buildings' ]);
        $this->insert('accounts', [ 'id'=>1900, 'code'=>'1900', 'parent_id'=>1000, 'active'=>1, 'checking'=>0, 'name'=>'Other Assets' ]);
        $this->insert('accounts', [ 'id'=>1990, 'code'=>'1990', 'parent_id'=>1900, 'active'=>1, 'checking'=>0, 'name'=>'Other Assets' ]);
        $this->insert('accounts', [ 'id'=>2000, 'code'=>'2000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Liabilities' ]);
        $this->insert('accounts', [ 'id'=>2100, 'code'=>'2100', 'parent_id'=>2000, 'active'=>1, 'checking'=>0, 'name'=>'Current Liabilities' ]);
        $this->insert('accounts', [ 'id'=>2110, 'code'=>'2110', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Accounts Payable' ]);
        $this->insert('accounts', [ 'id'=>2120, 'code'=>'2120', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Wages Payable' ]);
        $this->insert('accounts', [ 'id'=>2130, 'code'=>'2130', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Tax Payable' ]);
        $this->insert('accounts', [ 'id'=>2140, 'code'=>'2140', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Insurance Payable' ]);
        $this->insert('accounts', [ 'id'=>2180, 'code'=>'2180', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Accrued Expenses' ]);
        $this->insert('accounts', [ 'id'=>2190, 'code'=>'2190', 'parent_id'=>2100, 'active'=>1, 'checking'=>0, 'name'=>'Others Payable' ]);
        $this->insert('accounts', [ 'id'=>2200, 'code'=>'2200', 'parent_id'=>2000, 'active'=>1, 'checking'=>0, 'name'=>'Long-Term Liabilities' ]);
        $this->insert('accounts', [ 'id'=>2210, 'code'=>'2210', 'parent_id'=>2200, 'active'=>1, 'checking'=>0, 'name'=>'Equipments Payable' ]);
        $this->insert('accounts', [ 'id'=>2220, 'code'=>'2220', 'parent_id'=>2200, 'active'=>1, 'checking'=>0, 'name'=>'Vehicles Payable' ]);
        $this->insert('accounts', [ 'id'=>2230, 'code'=>'2230', 'parent_id'=>2200, 'active'=>1, 'checking'=>0, 'name'=>'Lands Payable' ]);
        $this->insert('accounts', [ 'id'=>2240, 'code'=>'2240', 'parent_id'=>2200, 'active'=>1, 'checking'=>0, 'name'=>'Buildings Payable' ]);
        $this->insert('accounts', [ 'id'=>2250, 'code'=>'2250', 'parent_id'=>2200, 'active'=>1, 'checking'=>0, 'name'=>'Bank Loans Payable' ]);
        $this->insert('accounts', [ 'id'=>3000, 'code'=>'3000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Equity' ]);
        $this->insert('accounts', [ 'id'=>3100, 'code'=>'3100', 'parent_id'=>3000, 'active'=>1, 'checking'=>0, 'name'=>'Capital' ]);
        $this->insert('accounts', [ 'id'=>3110, 'code'=>'3110', 'parent_id'=>3100, 'active'=>1, 'checking'=>0, 'name'=>'Owners Capital' ]);
        $this->insert('accounts', [ 'id'=>3190, 'code'=>'3190', 'parent_id'=>3100, 'active'=>1, 'checking'=>0, 'name'=>'Others Capital' ]);
        $this->insert('accounts', [ 'id'=>3200, 'code'=>'3200', 'parent_id'=>3000, 'active'=>1, 'checking'=>0, 'name'=>'Earnings' ]);
        $this->insert('accounts', [ 'id'=>3210, 'code'=>'3210', 'parent_id'=>3200, 'active'=>1, 'checking'=>0, 'name'=>'Retained Earnings' ]);
        $this->insert('accounts', [ 'id'=>3220, 'code'=>'3220', 'parent_id'=>3200, 'active'=>1, 'checking'=>0, 'name'=>'Current Earnings' ]);
        $this->insert('accounts', [ 'id'=>4000, 'code'=>'4000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Revenues' ]);
        $this->insert('accounts', [ 'id'=>4100, 'code'=>'4100', 'parent_id'=>4000, 'active'=>1, 'checking'=>0, 'name'=>'Retail Income' ]);
        $this->insert('accounts', [ 'id'=>4200, 'code'=>'4200', 'parent_id'=>4000, 'active'=>1, 'checking'=>0, 'name'=>'Retail Discount' ]);
        $this->insert('accounts', [ 'id'=>4300, 'code'=>'4300', 'parent_id'=>4000, 'active'=>1, 'checking'=>0, 'name'=>'Service Income' ]);
        $this->insert('accounts', [ 'id'=>4400, 'code'=>'4400', 'parent_id'=>4000, 'active'=>1, 'checking'=>0, 'name'=>'Service Discount' ]);
        $this->insert('accounts', [ 'id'=>4900, 'code'=>'4900', 'parent_id'=>4000, 'active'=>1, 'checking'=>0, 'name'=>'Other Income' ]);
        $this->insert('accounts', [ 'id'=>5000, 'code'=>'5000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Costs of Goods Sold' ]);
        $this->insert('accounts', [ 'id'=>5100, 'code'=>'5100', 'parent_id'=>5000, 'active'=>1, 'checking'=>0, 'name'=>'Retail COGS' ]);
        $this->insert('accounts', [ 'id'=>5200, 'code'=>'5200', 'parent_id'=>5000, 'active'=>1, 'checking'=>0, 'name'=>'Service COGS' ]);
        $this->insert('accounts', [ 'id'=>5300, 'code'=>'5300', 'parent_id'=>5000, 'active'=>1, 'checking'=>0, 'name'=>'Direct Labor Cost' ]);
        $this->insert('accounts', [ 'id'=>5400, 'code'=>'5400', 'parent_id'=>5000, 'active'=>1, 'checking'=>0, 'name'=>'Indirect Labor Cost' ]);
        $this->insert('accounts', [ 'id'=>5900, 'code'=>'5900', 'parent_id'=>5000, 'active'=>1, 'checking'=>0, 'name'=>'Other Costs' ]);
        $this->insert('accounts', [ 'id'=>6000, 'code'=>'6000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Expenses' ]);
        $this->insert('accounts', [ 'id'=>6100, 'code'=>'6100', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Purchase Expense' ]);
        $this->insert('accounts', [ 'id'=>6200, 'code'=>'6200', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Advertising Expense' ]);
        $this->insert('accounts', [ 'id'=>6300, 'code'=>'6300', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Maintenance Expenses' ]);
        $this->insert('accounts', [ 'id'=>6400, 'code'=>'6400', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Office Expenses' ]);
        $this->insert('accounts', [ 'id'=>6500, 'code'=>'6500', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Travel Expenses' ]);
        $this->insert('accounts', [ 'id'=>6600, 'code'=>'6600', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Entertainment Expenses' ]);
        $this->insert('accounts', [ 'id'=>6700, 'code'=>'6700', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Communication Expenses' ]);
        $this->insert('accounts', [ 'id'=>6800, 'code'=>'6800', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Legal and Tax Expenses' ]);
        $this->insert('accounts', [ 'id'=>6900, 'code'=>'6900', 'parent_id'=>6000, 'active'=>1, 'checking'=>0, 'name'=>'Other Expenses' ]);
        $this->insert('accounts', [ 'id'=>7000, 'code'=>'7000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Other Revenues' ]);
        $this->insert('accounts', [ 'id'=>7900, 'code'=>'7900', 'parent_id'=>7000, 'active'=>1, 'checking'=>0, 'name'=>'Other Revenues' ]);
        $this->insert('accounts', [ 'id'=>8000, 'code'=>'8000', 'parent_id'=>null, 'active'=>1, 'checking'=>0, 'name'=>'Other Costs' ]);
        $this->insert('accounts', [ 'id'=>8900, 'code'=>'8900', 'parent_id'=>8000, 'active'=>1, 'checking'=>0, 'name'=>'Other Costs' ]);

    }

    public function safeDown()
    {
        $this->dropTable('accounts');
    }
}
