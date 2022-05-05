<?php

namespace yiiseog\base;

use validators\ValidatorInterface;
use yii\base\Model as BaseModel;

class ModelAdapter extends BaseModel implements ValidatorInterface
{
    public function load($data, $formName = ''): bool
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope === '' && !empty($data)) {
            $this->setAttributes($data);
            return true;
        } elseif (isset($data[$scope])) {
            $this->setAttributes($data[$scope]);
            return true;
        }

        return false;
    }

    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        return parent::validate();
    }
}
