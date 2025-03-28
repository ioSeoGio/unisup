<?php

namespace app\modules\admin\controllers;

use domain\common\responses\PaginatedResponse;
use domain\teacherRate\Dto;
use domain\teacherRate\getAll\Formatter;
use factories\RequestFactory;
use models\search\TeacherRateFiltrator;
use domain\teacherRate\setAll\Action as SetRatesAction;
use OpenApi\Annotations as OA;

class TeacherRateController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private RequestFactory $requestFactory,
        private TeacherRateFiltrator $filtrator,
        private Formatter $formatter,

        private SetRatesAction $setRatesAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @OA\Get(
     *     path="/admin/teacher-rate/get-all",
     *     @OA\Response(response="200", description="Все ставки преподавателей"),
     *     @OA\Parameter(name="page", in="query"),
     *     @OA\Parameter(name="per-page", in="query"),
     *     @OA\Parameter(name="teacherName", in="query"),
     * )
     */
    public function actionGetAll(): PaginatedResponse
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    /**
     * @OA\Patch(
     *     path="/admin/teacher-rate/set-all",
     *     @OA\Response(response="200", description="Изменение ставок преподавателей"),
     *     @OA\RequestBody(@OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(example={
     *             {
     *                 "teacherId": 1,
     *                 "hours": 99.9
     *             }
     *         })
     *     ))
     * )
     */
    public function actionSetAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->setRatesAction->run(...$dtos);
    }
}
