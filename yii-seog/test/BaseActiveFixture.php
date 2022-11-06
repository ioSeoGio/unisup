<?php

namespace seog\test;

class BaseActiveFixture extends \yii\test\BaseActiveFixture
{
    public function load()
    {
        foreach($this->getData() as $modelData) {
            $model = new $this->modelClass();
            foreach ($modelData as $field => $value) {
                $model->$field = $value;
            }
            $model->save();
        }
    }

    public function unload()
    {
        parent::unload();
        $model = new $this->modelClass();
        $model::deleteAll();
        $this->db->createCommand()->resetSequence($model->tableName())->execute();
    }
}
