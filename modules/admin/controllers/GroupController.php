<?php

namespace app\modules\admin\controllers;

use models\search\GroupFiltrator;
use yii\data\ActiveDataProvider;

class GroupController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private GroupFiltrator $filtrator,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): ActiveDataProvider
    {
        return $this->filtrator->search();
    }
}
