<?php

namespace data;

use Yii;
use yii\db\ActiveRecord;

abstract class YiiArUpdater extends YiiDtoHandler implements UpdaterInterface
{
    public function updateOneById(int $id, array $data = []): object
    {
        $model = $this->findOne($id);
        return $this->updateOne($model, $data);
    }

    public function updateManyByIds(array $ids, array $data = []): array
    {
        $models = $this->findMany(['in', self::PRIMARY_KEY, $ids]);
        return $this->updateMany($models, $data);
    }

    public function updateOneByCriteria(array $criteria, array $data = []): object
    {
        $model = $this->findOne($criteria);
        return $this->updateOne($model, $data);
    }

    public function updateManyByCriteria(array $criteria = [], array $data = []): array
    {
        $models = $this->findMany($criteria);
        return $this->updateMany($models, $data);
    }

    /**
     * @param $model \yii\db\ActiveRecord
     * @param $data array
     *
     * @return object
     * @throws \Error
     */
    private function updateOne(ActiveRecord $model, array $data): object
    {
        $isUpdatedSuccessful = boolval($model->updateAttributes($data));
        if ($isUpdatedSuccessful) {
            return $this->factory->makeDto($model);
        }
        throw new \Error("Saving record id = $model->id failed.");
    }

    private function updateMany(array $models, array $data): array
    {
        $dtos = [];
        foreach ($models as $model) {
            $dtos[] = $this->updateOne($model, $data);
        }
        return $dtos;
    }
}
