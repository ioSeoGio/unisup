<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\getAll;

use models\TeacherTimeManagement;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): array
    {
        $result = [];

        /** @var TeacherTimeManagement $model */
        foreach ($dataProvider->getModels() as $model) {
            $result[] = [
                'teacher' => $model->getTeacher()->one(),
                'discipline' => $model->getDiscipline()->one(),
                'semester' => $model->getSemester()->one(),
                'hours' => $model->getHours(),
            ];
        }

        return $result;
    }
}
