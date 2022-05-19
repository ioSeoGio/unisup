<?php

namespace data;

abstract class YiiArCreator extends YiiDataHandler implements CreatorInterface
{
    public function create(array|object $data): object
    {
        $data = $this->makeArray($data);
        $model = new $this->query->modelClass($data);
        if ($model->save()) {
            return $model;
        }
        throw new \Error('Failed creating record');
    }

    /**
     * @param $data array
     * @return array
     */
    public function createMany(array $data): array
    {
        $dtos = [];
        foreach ($data as $attributesData) {
            $dtos[] = $this->create($attributesData);
        }
        return $dtos;
    }
}
