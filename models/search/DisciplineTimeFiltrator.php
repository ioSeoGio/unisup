<?php declare(strict_types=1);

namespace models\search;

use models\query\DisciplineTimeQuery;
use yii\data\ActiveDataProvider;

class DisciplineTimeFiltrator extends AbstractFiltrator
{
    public $id;
    public $discipline_id;
    public $course_id;
    public $semester_id;
    public $hours;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [
            [['id', 'discipline_id', 'course_id', 'semester_id'], 'integer'],
            [['hours'], 'double'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = (new DisciplineTimeQuery())
            ->with(['discipline', 'course', 'semester']);

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
            'hours' => $this->hours,
        ]);

        return $dataProvider;
    }
}
