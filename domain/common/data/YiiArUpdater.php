<?php declare(strict_types=1);

namespace data;

use yii\db\ActiveRecord;

abstract class YiiArUpdater extends YiiDataHandler implements UpdaterInterface
{
    public function updateOneById(int $id, array|object $data): object
    {
        $model = $this->getOne($id);
        return $this->updateOne($model, $data);
    }

    public function updateManyByIds(array $ids, array|object $data): array
    {
        $models = $this->findMany(['in', self::PRIMARY_KEY, $ids]);
        return $this->updateMany($models, $data);
    }

    public function updateOneByCriteria(array $criteria, array|object $data): object
    {
        $model = $this->getOne($criteria);
        return $this->updateOne($model, $data);
    }

    public function updateManyByCriteria(array $criteria, array|object $data): array
    {
        $models = $this->findMany($criteria);
        return $this->updateMany($models, $data);
    }

    private function updateOne(ActiveRecord $model, array|object $data): object
    {
        $data = $this->makeArray($data);
        $model = $this->fillDtoAttributes($model, $data);
        
        if ($model->save()) {
            return $model;
        }
        throw new \Error("Saving record id = $model->id failed.");
    }

    private function fillDtoAttributes(object $dto, array $data): object
    {
        foreach ($data as $key => $value) {
            $dto->$key = $value;
        }
        return $dto;
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
