<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\getAll;

use domain\common\responses\PaginatedResponse;
use models\Discipline;
use models\TeacherTimeManagement;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): PaginatedResponse
    {
        $result = [];

        /** @var TeacherTimeManagement $model */
        foreach ($dataProvider->getModels() as $model) {
            $semester = $model->getSemester()->one();
            /** @var Discipline $discipline */
            $discipline = $model->getDiscipline()->one();

            $result[] = [
                'teacher' => $model->getTeacher()->one(),
                'discipline' => $discipline,
                'semester' => $semester,
                'hours' => $model->getHours(),
                'maxHours' => $discipline->getDisciplineTimeBySemester($semester)->one()->hours,
            ];
        }

        return new PaginatedResponse($result, $dataProvider);
    }
}
