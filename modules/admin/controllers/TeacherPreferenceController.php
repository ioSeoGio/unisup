<?php

namespace app\modules\admin\controllers;

use domain\teacherPreference\writeAll\Action as WriteAllAction;
use domain\teacherPreference\writeAll\Dto;
use factories\RequestFactory;
use models\search\TeacherPreferenceFiltrator;
use domain\teacherPreference\getAll\Formatter;

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

    public function actionGetAll(): array
    {
        $raw = $this->filtrator->search();

        return $this->formatter->makeResponse($raw);
    }

    public function actionWriteAll(): void
    {
        $dtos = $this->requestFactory->makeDtos(Dto::class);
        $this->writeAllAction->run(...$dtos);
    }
}
