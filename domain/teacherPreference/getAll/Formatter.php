<?php declare(strict_types=1);

namespace domain\teacherPreference\getAll;

use domain\common\responses\PaginatedResponse;
use models\TeacherPreference;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): PaginatedResponse
    {
        $result = [];

        /** @var TeacherPreference $model */
        foreach ($dataProvider->getModels() as $model) {
            $result[] = [
                'teacher' => $model->getTeacher()->one(),
                'semester' => $model->getSemester()->one(),
                'discipline' => $model->getDiscipline()->one(),
                'importance_coefficient' => $model->importance_coefficient,
            ];
        }

        return new PaginatedResponse($result, $dataProvider);
    }
}
