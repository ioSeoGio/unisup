<?php declare(strict_types=1);

namespace models\search;

use models\query\EducationalWorkReportQuery as Query;
use yii\data\ActiveDataProvider;

class EducationalWorkFiltrator extends AbstractFiltrator
{
    public $id;
    public $description;
    public $level;
    public $teacher_id;
    public $type_id;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['description', 'level'], 'string'],
            [['id', 'teacher_id', 'type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'teacher_id' => $this->teacher_id,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['ilike', 'description', $this->description]);
        $query->andFilterWhere(['ilike', 'level', $this->level]);

        return $dataProvider;
    }
}
