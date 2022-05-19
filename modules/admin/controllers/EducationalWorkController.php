<?php

namespace app\modules\admin\controllers;

use models\search\EducationalWorkFiltrator;

use domain\educationalWork\CreateRequestFactory;
use domain\educationalWork\CreateForm;
use domain\educationalWork\CreateAction;
use domain\educationalWork\CreateTransformer;

class EducationalWorkController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private EducationalWorkFiltrator $filtrator,

        private CreateRequestFactory $createRequestFactory,
        private CreateForm $createForm,
        private CreateAction $createAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => ['index', 'create'],
            'except' => [],
        ]);
    }

    public function verbActions()
    {
        return [
            'index' => ['get'],
            'create' => ['post'],
        ];
    }

    public function actionIndex()
    {
        return $this->filtrator->search($this->request);
    }

    public function actionCreate()
    {
        $dto = $this->createRequestFactory->makeDto();
        if ($this->createForm->load($dto) && $this->createForm->validate()) {
            $result = $this->createAction->run($dto);
            return (new CreateTransformer($result))->makeResponse();
        }
        return $this->createForm;
    }
}
