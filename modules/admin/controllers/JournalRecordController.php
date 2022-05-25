<?php

namespace app\modules\admin\controllers;

use models\search\JournalRecordFiltrator as Filtrator;

use domain\journalRecord\ReadAction;
use domain\journalRecord\ReadRequestFactory;

use domain\journalRecord\CreateRequestFactory;
use domain\journalRecord\CreateForm;
use domain\journalRecord\CreateAction;

use domain\journalRecord\UpdateRequestFactory;
use domain\journalRecord\UpdateForm;
use domain\journalRecord\UpdateAction;

use domain\journalRecord\DeleteAction;
use domain\journalRecord\DeleteRequestFactory;

use domain\journalRecord\Transformer;

class JournalRecordController extends BaseModuleController
{
    public function __construct(
        $id,
        $module,

        private Filtrator $filtrator,
        
        private ReadRequestFactory $readRequestFactory,
        private ReadAction $readAction,

        private CreateRequestFactory $createRequestFactory,
        private CreateForm $createForm,
        private CreateAction $createAction,

        private UpdateRequestFactory $updateRequestFactory,
        private UpdateForm $updateForm,
        private UpdateAction $updateAction,

        private DeleteRequestFactory $deleteRequestFactory,
        private DeleteAction $deleteAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->filtrator->search($this->request);
    }

    public function actionRead()
    {
        $dto = $this->readRequestFactory->makeDto();
        $result = $this->readAction->run($dto);
        return (new Transformer($result))->makeResponse();
    }

    public function actionCreate()
    {
        $dto = $this->createRequestFactory->makeDto();
        if ($this->createForm->load($dto) && $this->createForm->validate()) {
            $result = $this->createAction->run($dto);
            return (new Transformer($result))->makeResponse();
        }
        return $this->createForm;
    }

    public function actionUpdate()
    {
        $dto = $this->updateRequestFactory->makeDto();
        if ($this->updateForm->load($dto) && $this->updateForm->validate()) {
            $result = $this->updateAction->run($dto);
            return (new Transformer($result))->makeResponse();
        }
        return $this->updateForm;
    }

    public function actionDelete()
    {
        $dto = $this->deleteRequestFactory->makeDto();
        return $this->deleteAction->run($dto);
    }
}
