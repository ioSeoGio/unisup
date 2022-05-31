<?php

namespace models\search;

use data\FiltratorInterface;
use models\query\JournalRecordQuery as Query;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

class JournalRecordFiltrator extends ModelAdapter implements FiltratorInterface
{
    public $id;
    public $topic;
    public $class_type;
    public $journal_id;
    public $teacher_id;
    public $group_id;
    public $lesson_at;

    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['id', 'class_type', 'journal_id', 'teacher_id', 'group_id'], 'integer'],
            [['topic', 'lesson_at'], 'string'],
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
