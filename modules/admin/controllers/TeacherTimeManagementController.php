<?php

namespace app\modules\admin\controllers;

use domain\teacherTimeManagement\setAll\Action as SetAllAction;
use domain\teacherTimeManagement\Dto;
use factories\RequestFactory;
use domain\teacherTimeManagement\getAll\Formatter;
use models\search\TeacherTimeManagementFiltrator;

class TeacherTimeManagementController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private TeacherTimeManagementFiltrator $filtrator,
        private Formatter $formatter,
        private RequestFactory $requestFactory,

        private SetAllAction $setAllAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionGetAll(): array
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    public function actionSetAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->setAllAction->run(...$dtos);
    }
}
