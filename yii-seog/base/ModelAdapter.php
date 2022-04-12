<?php

namespace seog\base;

use yii\base\Model as BaseModel;
use validators\ValidatorInterface;

class ModelAdapter extends BaseModel implements ValidatorInterface
{
    public function load($data, $formName = ''): bool
    {
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