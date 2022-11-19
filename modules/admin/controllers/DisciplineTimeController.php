<?php

namespace app\modules\admin\controllers;

use domain\disciplineTime\writeAll\Action as SetAllAction;
use domain\disciplineTime\writeAll\Dto;
use factories\RequestFactory;
use domain\disciplineTime\getAll\Formatter;
use models\search\DisciplineTimeFiltrator;

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
