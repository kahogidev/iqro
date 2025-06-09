<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Teachers;

/**
 * TeachersSearch represents the model behind the search form of `common\models\Teachers`.
 */
class TeachersSearch extends Teachers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'experience_years', 'weekly_hours'], 'integer'],
            [['first_name','last_name','middle_name', 'passport_series_number', 'birth_date', 'gender', 'nationality', 'marital_status', 'permanent_address', 'current_address', 'registered_address', 'photo', 'personal_phone', 'additional_phone', 'contact_info', 'hire_date', 'position', 'department', 'specialization', 'academic_degree', 'certificates', 'diploma', 'subjects', 'classes', 'passport_image', 'diploma_image', 'certificate_image', 'hire_order_image', 'contract_pdf'], 'safe'],
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
        $query = Teachers::find();

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
            'hire_date' => $this->hire_date,
            'experience_years' => $this->experience_years,
            'weekly_hours' => $this->weekly_hours,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'passport_series_number', $this->passport_series_number])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'current_address', $this->current_address])
            ->andFilterWhere(['like', 'registered_address', $this->registered_address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'personal_phone', $this->personal_phone])
            ->andFilterWhere(['like', 'additional_phone', $this->additional_phone])
            ->andFilterWhere(['like', 'contact_info', $this->contact_info])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'specialization', $this->specialization])
            ->andFilterWhere(['like', 'academic_degree', $this->academic_degree])
            ->andFilterWhere(['like', 'certificates', $this->certificates])
            ->andFilterWhere(['like', 'diploma', $this->diploma])
            ->andFilterWhere(['like', 'subjects', $this->subjects])
            ->andFilterWhere(['like', 'classes', $this->classes])
            ->andFilterWhere(['like', 'passport_image', $this->passport_image])
            ->andFilterWhere(['like', 'diploma_image', $this->diploma_image])
            ->andFilterWhere(['like', 'certificate_image', $this->certificate_image])
            ->andFilterWhere(['like', 'hire_order_image', $this->hire_order_image])
            ->andFilterWhere(['like', 'contract_pdf', $this->contract_pdf]);

        return $dataProvider;
    }
}
