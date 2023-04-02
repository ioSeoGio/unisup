<?php declare(strict_types=1);

namespace domain\disciplineTime\getAll;

use domain\common\responses\PaginatedResponse;
use models\DisciplineTime;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): PaginatedResponse
    {
        $result = [];

        /** @var DisciplineTime $model */
        foreach ($dataProvider->getModels() as $model) {
            $result[] = [
                'discipline' => $model->getDiscipline()->one(),
                'semester' => $model->getSemester()->one(),
                'hours' => $model->hours,
            ];
        }

        return new PaginatedResponse($result, $dataProvider);
    }
}
