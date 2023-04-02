<?php declare(strict_types=1);

namespace models\search;

use models\query\TeacherRateQuery;
use yii\data\ActiveDataProvider;

class TeacherRateFiltrator extends AbstractFiltrator
{
    public $teacherId;
    public $teacherName;
    public $hours;

    public function rules()
    {
        return [
            [['teacherId'], 'integer'],
            [['teacherName'], 'string'],
            [['hours'], 'double'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = (new TeacherRateQuery())
            ->joinWith(['teacher']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'teacher_id' => $this->teacherId,
            'hours' => $this->hours,
        ]);
        $query->andFilterWhere(['ilike', 'teachers.full_name', $this->teacherName]);

        return $dataProvider;
    }
}
