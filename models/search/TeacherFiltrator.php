<?php declare(strict_types=1);

namespace models\search;

use data\FiltratorInterface;
use models\query\TeacherQuery as Query;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

class TeacherFiltrator extends ModelAdapter implements FiltratorInterface
{
    public $id;
    public $department_id;
    public $academic_degree_id;
    public $academic_title_id;
    public $teacher_post_id;

    public $full_name;
    public $working_since;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id', 'department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id'], 'integer'],
            [['full_name', 'working_since', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search(RequestAdapterInterface $request): ActiveDataProvider
    {
        $query = new Query();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'department_id' => $this->department_id,
            'academic_degree_id' => $this->academic_degree_id,
            'academic_title_id' => $this->academic_title_id,
            'teacher_post_id' => $this->teacher_post_id,
            'working_since' => $this->working_since,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['ilike', 'full_name', $this->full_name]);

        return $dataProvider;
    }
}