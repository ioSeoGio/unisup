<?php declare(strict_types=1);

namespace models\search;

use models\query\CourseQuery;
use yii\data\ActiveDataProvider;

class CourseFiltrator extends AbstractFiltrator
{
    public $name;

    public function rules(): array
    {
        return [
            [['name'], 'string'],
        ];
    }

    public function search(): ActiveDataProvider
    {
        $query = (new CourseQuery())->with('semesters');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'name' => $this->name,
        ]);

        return $dataProvider;
    }
}
