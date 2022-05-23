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

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => ['index'],
            'except' => [],
        ]);
    }

    public function verbActions()
    {
        return [
            'index' => ['get'],
            'read' => ['get'],
            'create' => ['post'],
            'update' => ['post'],
        ];
    }

    public function actionIndex()
    {
        return $this->teacherFiltrator->search($this->request);
    }
}
