<?php

namespace data;

use yii\db\ActiveRecord;

abstract class YiiArUpdater implements UpdaterInterface
{
    public function __construct(private string $modelClass) {}

    /**
     * @param $id int
     * @param $data array
     *
     * @return bool
     */
    public function updateOneById(int $id, array $data = []): bool
    {
        $model = $this->modelClass::findOne($id);
        return $this->updateOne($model, $data);
    }

    /**
     * @param $ids array
     * @param $data array
     *
     * @return bool
     */
    public function updateManyByIds(array $ids, array $data = []): bool
    {
        $models = $this->modelClass::find()
            ->where(['in', self::PRIMARY_KEY, $ids])
            ->all();
        return $this->updateMany($models, $data);
    }

    /**
     * @param $criteria array
     * @param $data array
     *
     * @return bool
     */
    public function updateOneByCriteria(array $criteria, array $data = []): bool
    {
        $model = $this->modelClass::findOne()
            ->where($criteria)
            ->one();
        return $this->updateOne($model, $data);
    }

    /**
     * @param $criteria array
     * @param $data array
     *
     * @return bool
     */
    public function updateManyByCriteria(array $criteria = [], array $data = []): bool
    {
        $models = $this->modelClass::findOne()
            ->where($criteria)
            ->all();
        return $this->updateMany($models, $data);
    }

    /**
     * @param $model \yii\db\ActiveRecord
     * @param $data array
     *
     * @return bool
     */
    private function updateOne(ActiveRecord $model, array $data): bool
    {
        $affectedRowsNumber = $model->updateAttributes($data);
        return boolval($affectedRowsNumber);
    }

    /**
     * @param $models array
     * @param $data array
     *
     * @return bool
     */
    public function updateMany(array $models, array $data): bool
    {
        $flag = true;
        foreach ($models as $model) {
            $flag &= $this->updateOne($model, $data);
        }
        return $flag;
    }
}
