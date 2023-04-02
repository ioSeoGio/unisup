<?php declare(strict_types=1);

namespace domain\course\getAll;

use domain\common\responses\PaginatedResponse;
use models\Course;
use yii\data\ActiveDataProvider;

class Formatter
{
    public function makeResponse(ActiveDataProvider $dataProvider): PaginatedResponse
    {
        $result = [];

        /** @var Course $model */
        foreach ($dataProvider->getModels() as $model) {
            $data = $model->getAttributes();
            $data['semesters'] = $model->semesters;

            $result[] = $data;
        }

        return new PaginatedResponse($result, $dataProvider);
    }
}
