<?php

namespace app\modules\admin\controllers;

use models\search\WorkReportTypeFiltrator;

class WorkReportTypeController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private WorkReportTypeFiltrator $filtrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->filtrator->search($this->request);
    }
}
