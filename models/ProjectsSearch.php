<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form about `app\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'parent_id', 'created_by', 'created_on', 'modified_by', 'modified_on'], 'integer'],
            [['code', 'name', 'description', 'location', 'contract_num', 'contact_person', 'contact_phone', 'date_start_est', 'date_finish_est', 'date_start_actual', 'date_finish_actual', 'status'], 'safe'],
            [['value', 'progress_pct'], 'number'],
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
        $query = Projects::find();

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
            'value' => $this->value,
            'active' => $this->active,
            'parent_id' => $this->parent_id,
            'date_start_est' => $this->date_start_est,
            'date_finish_est' => $this->date_finish_est,
            'date_start_actual' => $this->date_start_actual,
            'date_finish_actual' => $this->date_finish_actual,
            'progress_pct' => $this->progress_pct,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'modified_by' => $this->modified_by,
            'modified_on' => $this->modified_on,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'contract_num', $this->contract_num])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
