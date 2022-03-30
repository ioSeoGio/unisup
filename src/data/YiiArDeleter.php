<?php

namespace data;

abstract class YiiArDeleter implements CreatorInterface
{
    public function __construct(private string $modelClass) {}

    /**
     * @param $id int
     * @return bool
     */
    public function deleteOneById(int $id): bool
    {
        $model = $this->modelClass::findOne($id);
        return $this->deleteOne($model);
    }

    /**
     * @param $ids array
     * @return bool
     */
    public function deleteManyByIds(array $ids): bool
    {
        $models = $this->modelClass::find()
            ->where(['in', self::PRIMARY_KEY, $ids])
            ->all();
        return $this->deleteMany($models);
    }

    /**
     * @param $criteria array
     * @return bool
     */
    public function deleteOneByCriteria(array $criteria = []): bool
    {
        $model = $this->modelClass::find()
            ->where($criteria)
            ->one();
        return $this->deleteOne($model);
    }

    public function deleteManyByCriteria(array $criteria = []): bool
    {
        $models = $this->modelClass::find()
            ->where($criteria)
            ->one();
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
     * @param $model ActiveRecord
     * @return bool
     */
    private function deleteOne(ActiveRecord $model): bool
    {
        return $model->delete();
    }
}
