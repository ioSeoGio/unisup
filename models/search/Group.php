<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Group as GroupModel;

/**
* Group represents the model behind the search form about `app\models\Group`.
*/
class Group extends GroupModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'course_id', 'number_of_students', 'faculty_id', 'specialization_id'], 'integer'],
            [['name', 'form_of_study', 'start_of_study', 'end_of_study', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return parent::scenarios();
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
        $query = GroupModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'course_id' => $this->course_id,
            'number_of_students' => $this->number_of_students,
            'faculty_id' => $this->faculty_id,
            'specialization_id' => $this->specialization_id,
            'start_of_study' => $this->start_of_study,
            'end_of_study' => $this->end_of_study,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'form_of_study', $this->form_of_study]);

        return $dataProvider;
    }
}