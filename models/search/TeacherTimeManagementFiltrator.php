<?php declare(strict_types=1);

namespace models\search;

use models\query\TeacherTimeManagementQuery;
use yii\data\ActiveDataProvider;

class TeacherTimeManagementFiltrator extends AbstractFiltrator
{
    public $semesterId;
    public $semesterName;
    public $disciplineId;
    public $disciplineName;
    public $teacherId;
    public $teacherName;
    public $hours;

    public function rules(): array
    {
        return [
            [['semesterId', 'disciplineId', 'teacherId'], 'integer'],
            [['disciplineName', 'teacherName', 'semesterName'], 'string'],
            [['hours'], 'double'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = (new TeacherTimeManagementQuery())
            ->joinWith([
                'teacher',
                'discipline',
                'semester',
            ])
            ->with('discipline.disciplineTimes');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'semester_id' => $this->semesterId,
            'discipline_id' => $this->disciplineId,
            'teacher_id' => $this->teacherId,
            'hours' => $this->hours,
        ]);
        $query->andFilterWhere(['ilike', 'teachers.full_name', $this->teacherName]);
        $query->andFilterWhere(['ilike', 'disciplines.name', $this->disciplineName]);
        $query->andFilterWhere(['ilike', 'semesters.name', $this->semesterName]);

        return $dataProvider;
    }
}
