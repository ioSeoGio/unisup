<?php

namespace app\modules\admin\controllers;

use domain\teacherRate\Dto;
use domain\teacherRate\getAll\Formatter;
use factories\RequestFactory;
use models\search\TeacherRateFiltrator;
use domain\teacherRate\setAll\Action as SetRatesAction;
use OpenApi\Annotations as OA;

class TeacherRatesController extends BaseModuleController
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
     *     path="/teacher-rates/get-all",
     *     @OA\Response(response="200", description="Все ставки преподавателей")
     * )
     */
    public function actionGetAll(): array
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    public function actionSetAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->setRatesAction->run(...$dtos);
    }
}
