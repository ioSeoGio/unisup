<?php

namespace app\modules\admin\controllers;

use models\search\TeacherPreferenceFiltrator;
use yii\data\ActiveDataProvider;

class TeacherPreferenceController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private TeacherPreferenceFiltrator $filtrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionGetAll(): ActiveDataProvider
    {
        return $this->filtrator->search($this->request);
    }
}
