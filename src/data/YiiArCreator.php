<?php

namespace data;

abstract class YiiArCreator implements CreatorInterface
{
    public function __construct(private string $modelClass) {}

    /**
     * @param $data array
     * @return bool
     */
    public function create(array $data): bool
    {
        $model = new $this->modelClass($data);
        return $model->save();
    }

    /**
     * @param $data array
     * @return bool
     */
    public function createMany(array $data): bool
    {
        $flag = true;

        foreach ($data as $key => $attributesData) {
            $model = new $this->modelClass($attributesData);
            $flag &= $model->save();
        }

        return $flag;
    }
}
