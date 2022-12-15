<?php

namespace app\modules\admin\controllers;

use domain\course\getAll\Formatter;
use models\search\CourseFiltrator;
use OpenApi\Annotations as OA;

class CourseController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private CourseFiltrator $filtrator,
        private Formatter $formatter,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @OA\Get(
     *     path="/admin/course/get-all",
     *     @OA\Response(response="200", description="Список курсов и семестров")
     * )
     */
    public function actionGetAll(): array
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }
}
