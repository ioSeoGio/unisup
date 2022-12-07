<?php

namespace app\modules\admin\controllers;

use domain\disciplineTime\writeAll\Action as SetAllAction;
use domain\disciplineTime\writeAll\Dto;
use factories\RequestFactory;
use domain\disciplineTime\getAll\Formatter;
use models\search\DisciplineTimeFiltrator;
use OpenApi\Annotations as OA;

class DisciplineTimeController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private DisciplineTimeFiltrator $filtrator,
        private Formatter $formatter,
        private RequestFactory $requestFactory,

        private SetAllAction $setAllAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @OA\Get(
     *     path="/admin/discipline-time/get-all",
     *     @OA\Response(response="200", description="Все часы по всем дисциплинам")
     * )
     */
    public function actionGetAll(): array
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    /**
     * @OA\Post(
     *     path="/admin/discipline-time/set-all",
     *     @OA\Response(response="200", description="Изменение часов дисциплин"),
     *     @OA\RequestBody(@OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(example={
     *             {
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
}
