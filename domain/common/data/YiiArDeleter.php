<?php

namespace data;

use seog\db\ActiveRecordAdapter;

abstract class YiiArDeleter extends YiiDataHandler implements DeleterInterface
{
    public function deleteOneById(int $id): bool
    {
        $model = $this->getOne($id);
        return $this->deleteOne($model);
    }

    public function deleteOneByCriteria(array $criteria): bool
    {
        $model = $this->getOne($criteria);
        return $this->deleteOne($model);
    }
    
    private function deleteOne(ActiveRecordAdapter $model): bool
    {
        return $model->delete() !== false;
    }

    public function deleteManyByIds(array $ids): bool
    {
        return $this->query
            ->modelClass::deleteAll(['in', self::PRIMARY_KEY, $ids]);
    }

    public function deleteManyByCriteria(array $criteria): bool
    {
        return $this->query
            ->modelClass::deleteAll($criteria);
    }
}
