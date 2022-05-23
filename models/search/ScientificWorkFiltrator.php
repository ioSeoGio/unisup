<?php

namespace models\search;

use data\FiltratorInterface;
use models\query\ScientificWorkReportQuery as Query;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

class ScientificWorkFiltrator extends ModelAdapter implements FiltratorInterface
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