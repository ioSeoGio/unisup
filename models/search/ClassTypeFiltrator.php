<?php declare(strict_types=1);

namespace models\search;

use yii\data\ActiveDataProvider;
use models\query\ClassTypeQuery as Query;
use data\FiltratorInterface;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;

class ClassTypeFiltrator extends AbstractFiltrator
{
    public $id;
    public $name;
    public $time_coefficient;

    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
            [['time_coefficient'], 'number'],
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
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
