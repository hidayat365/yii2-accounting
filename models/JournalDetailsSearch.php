<?php

namespace app\modules\accounting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\accounting\models\JournalDetails;

/**
 * JournalDetailsSearch represents the model behind the search form about `app\modules\accounting\models\JournalDetails`.
 */
class JournalDetailsSearch extends JournalDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'journal_id', 'account_id', 'department_id', 'project_id', 'reference_id', 'reference_date', 'order_id', 'order_date', 'invoice_id', 'invoice_date', 'item_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['debet', 'debet_real', 'credit', 'credit_real', 'currency_rate1', 'currency_rate2', 'quantity', 'unit_price', 'tax1_pct', 'tax2_pct', 'disc1_pct', 'disc2_pct'], 'number'],
            [['reference_num', 'order_num', 'invoice_num', 'remarks'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = JournalDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'journal_id' => $this->journal_id,
            'debet' => $this->debet,
            'debet_real' => $this->debet_real,
            'credit' => $this->credit,
            'credit_real' => $this->credit_real,
            'currency_rate1' => $this->currency_rate1,
            'currency_rate2' => $this->currency_rate2,
            'account_id' => $this->account_id,
            'department_id' => $this->department_id,
            'project_id' => $this->project_id,
            'reference_id' => $this->reference_id,
            'reference_date' => $this->reference_date,
            'order_id' => $this->order_id,
            'order_date' => $this->order_date,
            'invoice_id' => $this->invoice_id,
            'invoice_date' => $this->invoice_date,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'tax1_pct' => $this->tax1_pct,
            'tax2_pct' => $this->tax2_pct,
            'disc1_pct' => $this->disc1_pct,
            'disc2_pct' => $this->disc2_pct,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'reference_num', $this->reference_num])
            ->andFilterWhere(['like', 'order_num', $this->order_num])
            ->andFilterWhere(['like', 'invoice_num', $this->invoice_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function items($params)
    {
        $query = JournalDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where(['not',['item_id'=>null]]);
        $query->andFilterWhere([
            'id' => $this->id,
            'journal_id' => $this->journal_id,
            'debet' => $this->debet,
            'debet_real' => $this->debet_real,
            'credit' => $this->credit,
            'credit_real' => $this->credit_real,
            'currency_rate1' => $this->currency_rate1,
            'currency_rate2' => $this->currency_rate2,
            'account_id' => $this->account_id,
            'department_id' => $this->department_id,
            'project_id' => $this->project_id,
            'reference_id' => $this->reference_id,
            'reference_date' => $this->reference_date,
            'order_id' => $this->order_id,
            'order_date' => $this->order_date,
            'invoice_id' => $this->invoice_id,
            'invoice_date' => $this->invoice_date,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'tax1_pct' => $this->tax1_pct,
            'tax2_pct' => $this->tax2_pct,
            'disc1_pct' => $this->disc1_pct,
            'disc2_pct' => $this->disc2_pct,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'reference_num', $this->reference_num])
            ->andFilterWhere(['like', 'order_num', $this->order_num])
            ->andFilterWhere(['like', 'invoice_num', $this->invoice_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function invoices($params)
    {
        $query = JournalDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where(['not',['invoice_id'=>null]]);
        $query->andFilterWhere([
            'id' => $this->id,
            'journal_id' => $this->journal_id,
            'debet' => $this->debet,
            'debet_real' => $this->debet_real,
            'credit' => $this->credit,
            'credit_real' => $this->credit_real,
            'currency_rate1' => $this->currency_rate1,
            'currency_rate2' => $this->currency_rate2,
            'account_id' => $this->account_id,
            'department_id' => $this->department_id,
            'project_id' => $this->project_id,
            'reference_id' => $this->reference_id,
            'reference_date' => $this->reference_date,
            'order_id' => $this->order_id,
            'order_date' => $this->order_date,
            'invoice_date' => $this->invoice_date,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'tax1_pct' => $this->tax1_pct,
            'tax2_pct' => $this->tax2_pct,
            'disc1_pct' => $this->disc1_pct,
            'disc2_pct' => $this->disc2_pct,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'reference_num', $this->reference_num])
            ->andFilterWhere(['like', 'order_num', $this->order_num])
            ->andFilterWhere(['like', 'invoice_num', $this->invoice_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
