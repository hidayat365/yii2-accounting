<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Journals;
use app\models\JournalTypes;

/**
 * ReceiveSearch represents the model behind the search form about `app\models\Journals`.
 */
class ReceiveSearch extends Journals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['id', 'journal_date', 'posted', 'payment', 'closing', 'type_id', 'account_id', 'currency_id', 'reference_id', 'reference_date', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
          [['journal_num', 'remarks', 'reference_num'], 'safe'],
          [['journal_value', 'journal_value_real', 'currency_rate1', 'currency_rate2', 'currency_reval'], 'number'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'journal_date' => $this->journal_date,
            'journal_value' => $this->journal_value,
            'journal_value_real' => $this->journal_value_real,
            'posted' => $this->posted,
            'payment' => $this->payment,
            'closing' => $this->closing,
            'type_id' => JournalTypes::find()->where(['code' => 'BRV'])->one()->id,
            'account_id' => $this->account_id,
            'currency_id' => $this->currency_id,
            'currency_rate1' => $this->currency_rate1,
            'currency_rate2' => $this->currency_rate2,
            'currency_reval' => $this->currency_reval,
            'reference_id' => $this->reference_id,
            'reference_date' => $this->reference_date,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'journal_num', $this->journal_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'reference_num', $this->reference_num]);

        return $dataProvider;
    }
}
