<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Students;

/**
 * StudentsSearch represents the model behind the search form of `common\models\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'birth_date', 'birth_place', 'address', 'father_name', 'mother_name', 'mother_phone', 'father_workplace', 'mother_workplace', 'father_position', 'mother_position', 'talents', 'activities', 'behavior', 'health', 'special_needs', 'admission_date', 'photo', 'specialization', 'emergency_contact', 'emergency_phone'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Students::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'birth_date' => $this->birth_date,
            'admission_date' => $this->admission_date,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'birth_place', $this->birth_place])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'mother_phone', $this->mother_phone])
            ->andFilterWhere(['like', 'father_workplace', $this->father_workplace])
            ->andFilterWhere(['like', 'mother_workplace', $this->mother_workplace])
            ->andFilterWhere(['like', 'father_position', $this->father_position])
            ->andFilterWhere(['like', 'mother_position', $this->mother_position])
            ->andFilterWhere(['like', 'talents', $this->talents])
            ->andFilterWhere(['like', 'activities', $this->activities])
            ->andFilterWhere(['like', 'behavior', $this->behavior])
            ->andFilterWhere(['like', 'health', $this->health])
            ->andFilterWhere(['like', 'special_needs', $this->special_needs])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'specialization', $this->specialization])
            ->andFilterWhere(['like', 'emergency_contact', $this->emergency_contact])
            ->andFilterWhere(['like', 'emergency_phone', $this->emergency_phone]);

        return $dataProvider;
    }
}
