<?php

namespace app\modules\admin\controllers;

use domain\common\responses\PaginatedResponse;
use domain\teacherTimeManagement\service\AbstractTimeManagementCalculator;
use domain\teacherTimeManagement\setAll\Action as SetAllAction;
use domain\teacherTimeManagement\Dto;
use factories\RequestFactory;
use domain\teacherTimeManagement\getAll\Formatter;
use models\search\TeacherTimeManagementFiltrator;
use OpenApi\Annotations as OA;

class TeacherTimeManagementController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private TeacherTimeManagementFiltrator $filtrator,
        private Formatter $formatter,
        private RequestFactory $requestFactory,

        private SetAllAction $setAllAction,
        private AbstractTimeManagementCalculator $timeManagementCalculator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function verbActions(): array
    {
        return array_merge_recursive(parent::verbActions(), [
            'generate-new' => ['put', 'options']
        ]);
    }

    /**
     * @OA\Get(
     *     path="/admin/teacher-time-management/get-all",
     *     @OA\Response(
     *         response="200",
     *         description="Список отданных преподавателям часов по дисциплинам и семестрам"
     *     ),
     *     @OA\Parameter(name="page", in="query"),
     *     @OA\Parameter(name="per-page", in="query"),
     *     @OA\Parameter(name="disciplineName", in="query"),
     *     @OA\Parameter(name="teacherName", in="query"),
     *     @OA\Parameter(name="semesterName", in="query"),
     *     @OA\Parameter(name="disciplineId", in="query"),
     *     @OA\Parameter(name="teacherId", in="query"),
     *     @OA\Parameter(name="semesterId", in="query")
     * )
     */
    public function actionGetAll(): PaginatedResponse
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    /**
     * @OA\Patch(
     *     path="/admin/teacher-time-management/set-all",
     *     @OA\Response(
     *         response="200",
     *         description="Изменение часов преподавателей по дисциплинам и семестрам"
     *     ),
     *     @OA\RequestBody(@OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(example={
     *             {
     *                 "teacherId": 1,
     *                 "disciplineId": 1,
     *                 "semesterId": 1,
     *                 "hours": 99.9
     *             }
     *         })
     *     ))
     * )
     */
    public function actionSetAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->setAllAction->run(...$dtos);
    }

    /**
     * @OA\Put(
     *     path="/admin/teacher-time-management/generate-new",
     *     @OA\Response(
     *         response="200",
     *         description="Авто-генерация новых часов преподавателей по дисциплинам и семестрам"
     *     ),
     * )
     */
    public function actionGenerateNew(): PaginatedResponse
    {
        $this->timeManagementCalculator->calculate();
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }
}
