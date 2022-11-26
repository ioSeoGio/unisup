<?php declare(strict_types=1);

namespace models\search;

use models\query\TeacherTimeManagementQuery;
use yii\data\ActiveDataProvider;

class TeacherTimeManagementFiltrator extends AbstractFiltrator
{
    public $semesterId;
    public $disciplineId;
    public $teacherId;
    public $hours;

    public function rules(): array
    {
        return [
            [['semesterId', 'disciplineId', 'teacherId'], 'integer'],
            [['hours'], 'double'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = new TeacherTimeManagementQuery();
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

        return $dataProvider;
    }
}
