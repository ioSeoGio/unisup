<?php

namespace app\modules\admin\controllers;

use domain\common\responses\PaginatedResponse;
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
     *     @OA\Response(response="200", description="Список курсов и семестров"),
     *     @OA\Parameter(name="page", in="query"),
     *     @OA\Parameter(name="per-page", in="query")
     * )
     */
    public function actionGetAll(): PaginatedResponse
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }
}
