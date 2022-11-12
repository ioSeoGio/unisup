<?php declare(strict_types=1);

namespace models\search;

use yii\data\ActiveDataProvider;
use models\query\GroupQuery as Query;
use data\FiltratorInterface;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;

class GroupFiltrator extends AbstractFiltrator
{
    public $id;
    public $name;
    public $course_id;
    public $number_of_students;
    public $faculty_id;
    public $specialization_id;
    public $form_of_study;
    public $start_of_study;
    public $end_of_study;

    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id', 'course_id', 'number_of_students', 'faculty_id', 'specialization_id'], 'integer'],
            [['name', 'form_of_study', 'start_of_study', 'end_of_study', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = new Query();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());
        if (!$this->validate()) {
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
