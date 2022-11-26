<?php declare(strict_types=1);

namespace domain\teacherRate\getAll;

use models\TeacherRate;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): array
    {
        $result = [];

        /** @var TeacherRate $model */
        foreach ($dataProvider->getModels() as $model) {
            $result[] = [
                'teacher' => $model->getTeacher()->one(),
                'hours' => $model->hours,
            ];
        }

        return $result;
    }
}
