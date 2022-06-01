<?php

namespace app\modules\admin\controllers;

use models\search\ClassTypeFiltrator;

class ClassTypeController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private ClassTypeFiltrator $filtrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->filtrator->search($this->request);
    }
}
