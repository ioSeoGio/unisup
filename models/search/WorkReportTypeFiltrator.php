<?php declare(strict_types=1);

namespace models\search;

use models\query\WorkReportTypeQuery as Query;
use yii\data\ActiveDataProvider;

class WorkReportTypeFiltrator extends AbstractFiltrator
{
    public $id;
    public $serial_number;
    public $type;
    public $description;

    public $foreign_points;
    public $belarus_points;
    public $brest_points;

    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id', 'serial_number', 'foreign_points', 'belarus_points', 'brest_points'], 'integer'],
            [['type', 'description', 'created_at', 'updated_at'], 'safe'],
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
            'serial_number' => $this->serial_number,
            'type' => $this->type,

            'foreign_points' => $this->foreign_points,
            'belarus_points' => $this->belarus_points,
            'brest_points' => $this->brest_points,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
