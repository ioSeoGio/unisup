<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JournalRecord as JournalRecordModel;

/**
* JournalRecord represents the model behind the search form about `app\models\JournalRecord`.
*/
class JournalRecord extends JournalRecordModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'class_type', 'journal_id', 'teacher_id', 'group_id'], 'integer'],
            [['topic', 'lesson_at', 'created_at', 'updated_at'], 'safe'],
            [['hours_amount'], 'number'],
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
        $query = JournalRecordModel::find();

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
            'hours_amount' => $this->hours_amount,
            'class_type' => $this->class_type,
            'journal_id' => $this->journal_id,
            'teacher_id' => $this->teacher_id,
            'group_id' => $this->group_id,
            'lesson_at' => $this->lesson_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'topic', $this->topic]);

        return $dataProvider;
    }
}