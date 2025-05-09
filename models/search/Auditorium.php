<?php declare(strict_types=1);

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Auditorium as AuditoriumModel;

/**
 * Auditorium represents the model behind the search form about `app\models\Auditorium`.
 */
class Auditorium extends AuditoriumModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'auditorium_type_id', 'size_auditorium'], 'integer'],
            [['auditorium', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return parent::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AuditoriumModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'auditorium_type_id' => $this->auditorium_type_id,
            'size_auditorium' => $this->size_auditorium,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'auditorium', $this->auditorium]);

        return $dataProvider;
    }
}