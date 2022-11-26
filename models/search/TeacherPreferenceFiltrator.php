<?php declare(strict_types=1);

namespace models\search;

use models\query\TeacherPreferenceQuery;
use yii\data\ActiveDataProvider;

class TeacherPreferenceFiltrator extends AbstractFiltrator
{
    public $id;
    public $discipline_id;
    public $course_id;
    public $semester_id;
    public $teacher_id;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [
            [['id', 'discipline_id', 'course_id', 'semester_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = (new TeacherPreferenceQuery())
            ->with(['teacher', 'discipline']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'discipline_id' => $this->discipline_id,
            'course_id' => $this->course_id,
            'semester_id' => $this->semester_id,
            'teacher_id' => $this->teacher_id,
        ]);

        return $dataProvider;
    }
}
