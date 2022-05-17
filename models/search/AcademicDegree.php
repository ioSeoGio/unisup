<?php

namespace app\models\search;

use seog\base\ModelAdapter;
use yii\data\ActiveDataProvider;
use models\query\AcademicDegreeQuery;

class AcademicDegree extends ModelAdapter
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search(RequestAdapterInterface $request): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => new AcademicDegreeQuery(),
        ]);

        $this->load($request->getQueryParams());
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}