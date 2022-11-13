<?php declare(strict_types=1);

namespace models\search;

use models\query\TeacherQuery;
use models\query\TeacherRateQuery;
use yii\data\ActiveDataProvider;

class TeacherRateFiltrator extends AbstractFiltrator
{
    public $teacherId;
    public $hours;

    public function rules()
    {
        return [
            [['teacherId'], 'integer'],
            [['hours'], 'double'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = new TeacherRateQuery();
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

        return $dataProvider;
    }
}
