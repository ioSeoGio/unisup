<?php

namespace seog\base;

use yii\base\Model as BaseModel;

class Model extends BaseModel
{
    public function load($data, $formName = '')
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
}