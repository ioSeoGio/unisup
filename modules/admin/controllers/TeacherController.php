<?php

namespace app\modules\admin\controllers;

use models\search\TeacherFiltrator;

class TeacherController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private TeacherFiltrator $teacherFiltrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): array
    {
        return $this->teacherFiltrator->search()->getModels();
    }
}
