<?php

namespace app\modules\admin\controllers;

use models\search\EducationalWorkFiltrator;

class EducationalWorkController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private EducationalWorkFiltrator $educationalWorkFiltrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => ['index'],
            'except' => [],
        ]);
    }

    public function actionIndex()
    {
        return $this->educationalWorkFiltrator->search($this->request);
    }
}
