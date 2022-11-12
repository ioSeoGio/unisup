<?php

namespace domain\teacherPreference\getAll;

use models\TeacherPreference;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): array
    {
        $result = [];

        /** @var TeacherPreference $model */
        foreach ($dataProvider->getModels() as $model) {
            $result[] = [
                'teacher' => $model->getTeacher()->one(),
                'discipline' => $model->getDiscipline()->one(),
                'importance_coefficient' => $model->importance_coefficient,
            ];
        }

        return $result;
    }
}
