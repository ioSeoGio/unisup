<?php declare(strict_types=1);

namespace models\search;

use data\FiltratorInterface;
use models\query\JournalQuery as Query;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

class JournalFiltrator extends ModelAdapter implements FiltratorInterface
{
    public $id;
    public $name;
    public $teacher_id;
    public $discipline_id;
    
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id', 'teacher_id', 'discipline_id'], 'integer'],
            [['name'], 'string'],
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
            'discipline_id' => $this->discipline_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
