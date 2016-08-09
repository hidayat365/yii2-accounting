<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Journals;

/**
 * JournalsSearch represents the model behind the search form about `app\models\Journals`.
 */
class JournalsSearch extends Journals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'journal_date', 'posted', 'payment', 'closing', 'branch_id', 'type_id', 'account_id', 'source_id', 'currency_id', 'reference_id', 'reference_date', 'order_id', 'order_date', 'invoice_id', 'invoice_date', 'cost1_account_id', 'cost2_account_id', 'cost3_account_id', 'cost4_account_id', 'cost5_account_id', 'disc1_account_id', 'disc2_account_id', 'disc3_account_id', 'disc4_account_id', 'disc5_account_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['journal_num', 'remarks', 'reference_num', 'order_num', 'invoice_num'], 'safe'],
            [['journal_value', 'journal_value_real', 'currency_rate1', 'currency_rate2', 'currency_reval', 'cost1_value', 'cost1_value_real', 'cost2_value', 'cost2_value_real', 'cost3_value', 'cost3_value_real', 'cost4_value', 'cost4_value_real', 'cost5_value', 'cost5_value_real', 'disc1_value', 'disc1_value_real', 'disc2_value', 'disc2_value_real', 'disc3_value', 'disc3_value_real', 'disc4_value', 'disc4_value_real', 'disc5_value', 'disc5_value_real'], 'number'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Journals::find();

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
            'journal_date' => $this->journal_date,
            'journal_value' => $this->journal_value,
            'journal_value_real' => $this->journal_value_real,
            'posted' => $this->posted,
            'payment' => $this->payment,
            'closing' => $this->closing,
            'branch_id' => $this->branch_id,
            'type_id' => 10,
            'account_id' => $this->account_id,
            'source_id' => $this->source_id,
            'currency_id' => $this->currency_id,
            'currency_rate1' => $this->currency_rate1,
            'currency_rate2' => $this->currency_rate2,
            'currency_reval' => $this->currency_reval,
            'reference_id' => $this->reference_id,
            'reference_date' => $this->reference_date,
            'order_id' => $this->order_id,
            'order_date' => $this->order_date,
            'invoice_id' => $this->invoice_id,
            'invoice_date' => $this->invoice_date,
            'cost1_account_id' => $this->cost1_account_id,
            'cost1_value' => $this->cost1_value,
            'cost1_value_real' => $this->cost1_value_real,
            'cost2_account_id' => $this->cost2_account_id,
            'cost2_value' => $this->cost2_value,
            'cost2_value_real' => $this->cost2_value_real,
            'cost3_account_id' => $this->cost3_account_id,
            'cost3_value' => $this->cost3_value,
            'cost3_value_real' => $this->cost3_value_real,
            'cost4_account_id' => $this->cost4_account_id,
            'cost4_value' => $this->cost4_value,
            'cost4_value_real' => $this->cost4_value_real,
            'cost5_account_id' => $this->cost5_account_id,
            'cost5_value' => $this->cost5_value,
            'cost5_value_real' => $this->cost5_value_real,
            'disc1_account_id' => $this->disc1_account_id,
            'disc1_value' => $this->disc1_value,
            'disc1_value_real' => $this->disc1_value_real,
            'disc2_account_id' => $this->disc2_account_id,
            'disc2_value' => $this->disc2_value,
            'disc2_value_real' => $this->disc2_value_real,
            'disc3_account_id' => $this->disc3_account_id,
            'disc3_value' => $this->disc3_value,
            'disc3_value_real' => $this->disc3_value_real,
            'disc4_account_id' => $this->disc4_account_id,
            'disc4_value' => $this->disc4_value,
            'disc4_value_real' => $this->disc4_value_real,
            'disc5_account_id' => $this->disc5_account_id,
            'disc5_value' => $this->disc5_value,
            'disc5_value_real' => $this->disc5_value_real,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'journal_num', $this->journal_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'reference_num', $this->reference_num])
            ->andFilterWhere(['like', 'order_num', $this->order_num])
            ->andFilterWhere(['like', 'invoice_num', $this->invoice_num]);

        return $dataProvider;
    }
}
