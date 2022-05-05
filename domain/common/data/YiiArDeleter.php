<?php

namespace data;

use yiiseog\db\ActiveRecordAdapter;

abstract class YiiArDeleter extends YiiDataHandler implements DeleterInterface
{
    /**
     * @param $id int
     * @return bool
     */
    public function deleteOneById(int $id): bool
    {
        $model = $this->findOne($id);
        return $this->deleteOne($model);
    }

    /**
     * @param $ids array
     * @return bool
     */
    public function deleteManyByIds(array $ids): bool
    {
        $models = $this->findMany(['in', self::PRIMARY_KEY, $ids]);
        return $this->deleteMany($models);
    }

    /**
     * @param $criteria array
     * @return bool
     */
    public function deleteOneByCriteria(array $criteria = []): bool
    {
        $model = $this->findOne($criteria);
        return $this->deleteOne($model);
    }

    public function deleteManyByCriteria(array $criteria = []): bool
    {
        $models = $this->findMany($criteria);
        return $this->deleteMany($models);
    }

    /**
     * @param $models array
     * @return bool
     */
    private function deleteMany(array $models): bool
    {
        $flag = true;
        foreach ($models as $model) {
            $flag &= $this->deleteOne($model);
        }
        return $flag;
    }

    /**
     * @param $model ActiveRecordAdapter
     * @return bool
     */
    private function deleteOne(ActiveRecordAdapter $model): bool
    {
        return $model->delete();
    }
}
