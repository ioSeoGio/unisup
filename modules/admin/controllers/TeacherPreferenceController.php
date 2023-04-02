<?php

namespace app\modules\admin\controllers;

use domain\common\responses\PaginatedResponse;
use domain\teacherPreference\writeAll\Action as WriteAllAction;
use domain\teacherPreference\writeAll\Dto;
use factories\RequestFactory;
use models\search\TeacherPreferenceFiltrator;
use domain\teacherPreference\getAll\Formatter;
use OpenApi\Annotations as OA;

class TeacherPreferenceController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private TeacherPreferenceFiltrator $filtrator,
        private Formatter $formatter,
        private RequestFactory $requestFactory,

        private WriteAllAction $writeAllAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @OA\Get(
     *     path="/admin/teacher-preference/get-all",
     *     @OA\Response(response="200", description="Список предпочтений преподавателей"),
     *     @OA\Parameter(name="page", in="query"),
     *     @OA\Parameter(name="per-page", in="query")
     * )
     */
    public function actionGetAll(): PaginatedResponse
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    /**
     * @OA\Patch(
     *     path="/admin/teacher-preference/set-all",
     *     @OA\Response(response="200", description="Изменение предпочтений преподавателей"),
     *     @OA\RequestBody(@OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(example={
     *             {
     *                 "teacherId": 1,
     *                 "disciplineId": 1,
     *                 "semesterId": 1,
     *                 "importanceCoefficient": 99.9
     *             }
     *         })
     *     ))
     * )
     */
    public function actionSetAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->writeAllAction->run(...$dtos);
    }
}
