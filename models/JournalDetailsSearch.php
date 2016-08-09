<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JournalDetails;

/**
 * JournalDetailsSearch represents the model behind the search form about `app\models\JournalDetails`.
 */
class JournalDetailsSearch extends JournalDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'journal_id', 'account_id', 'department_id', 'project_id', 'reference_id', 'reference_date', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['debet', 'debet_real', 'credit', 'credit_real', 'currency_rate1', 'currency_rate2'], 'number'],
            [['reference_num', 'remarks'], 'safe'],
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
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'reference_num', $this->reference_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }

}
