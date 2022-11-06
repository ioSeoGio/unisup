<?php

namespace app\modules\admin\controllers;

use domain\methodicalWork\Dto;
use factories\RequestFactory;
use models\search\MethodicalWorkFiltrator as Filtrator;

use domain\methodicalWork\ReadAction;

use domain\methodicalWork\CreateForm;
use domain\methodicalWork\CreateAction;

use domain\methodicalWork\UpdateAction;

use domain\methodicalWork\DeleteAction;

use yii\data\ActiveDataProvider;

class MethodicalWorkController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private Filtrator $filtrator,
        
        private RequestFactory $requestFactory,
        private ReadAction $readAction,

        private CreateForm $createForm,
        private CreateAction $createAction,

        private UpdateAction $updateAction,

        private DeleteAction $deleteAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): ActiveDataProvider
    {
        return $this->filtrator->search($this->request);
    }

    public function actionRead(int $id): object
    {
        return $this->readAction->run($id);
    }

    public function actionCreate(): object|array
    {
        $dto = $this->requestFactory->makeDto(Dto::class);
        if ($this->createForm->load($dto) && $this->createForm->validate()) {
            return $this->createAction->run($dto);
        }
        return $this->createForm->getErrors();
    }

    public function actionUpdate(int $id): object|array
    {
        $dto = $this->requestFactory->makeDto(Dto::class);
        if ($this->createForm->load($dto) && $this->createForm->validate()) {
            return $this->updateAction->run($id, $dto);
        }
        return $this->createForm->getErrors();
    }

    public function actionDelete(int $id): bool
    {
        return $this->deleteAction->run($id);
    }
}
