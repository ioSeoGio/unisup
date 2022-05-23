<?php

namespace app\modules\documentBuilder\controllers;

use yii\filters\VerbFilter;

use domain\workReport\educationalWork\RequestFactory as EducationalWorkRequestFactory;
use domain\workReport\educationalWork\Form as EducationalWorkForm;
use domain\workReport\educationalWork\Action as EducationalWorkAction;
use domain\workReport\educationalWork\Transformer as EducationalWorkTransformer;

use domain\workReport\scientificWork\RequestFactory as ScientificWorkRequestFactory;
use domain\workReport\scientificWork\Form as ScientificWorkForm;
use domain\workReport\scientificWork\Action as ScientificWorkAction;
use domain\workReport\scientificWork\Transformer as ScientificWorkTransformer;

use domain\workReport\methodicalWork\RequestFactory as MethodicalWorkRequestFactory;
use domain\workReport\methodicalWork\Form as MethodicalWorkForm;
use domain\workReport\methodicalWork\Action as MethodicalWorkAction;
use domain\workReport\methodicalWork\Transformer as MethodicalWorkTransformer;

class SiteController extends BaseModuleController
{
    public function __construct(
        $id, 
        $module, 

        private EducationalWorkRequestFactory $educationalWorkRequestFactory,
        private EducationalWorkForm $educationalWorkForm,
        private EducationalWorkAction $educationalWorkAction,

        private ScientificWorkRequestFactory $scientificWorkRequestFactory,
        private ScientificWorkForm $scientificWorkForm,
        private ScientificWorkAction $scientificWorkAction,

        private MethodicalWorkRequestFactory $methodicalWorkRequestFactory,
        private MethodicalWorkForm $methodicalWorkForm,
        private MethodicalWorkAction $methodicalWorkAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function rules()
    {
        return array_merge_recursive(parent::rules(), [
            [
                'actions' => ['educational-work', 'scientific-work', 'methodical-work'],
                'allow' => true,
            ]
        ]);
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => [],
            'except' => ['educational-work', 'scientific-work', 'methodical-work'],
        ]);
    }

    public function verbActions()
    {
        return array_merge(parent::verbActions(), [
            'educational-work' => ['post', 'options'],
            'scientific-work' => ['post', 'options'],
            'methodical-work' => ['post', 'options'],
        ]);
    }

    public function actionEducationalWork()
    {
        $dto = $this->educationalWorkRequestFactory->makeDto();
        if ($this->educationalWorkForm->load($dto) && $this->educationalWorkForm->validate()) {
            $result = $this->educationalWorkAction->run($dto);
            return (new EducationalWorkTransformer($result))->makeResponse();
        }
        return $this->educationalWorkForm;
    }

    public function actionScientificWork()
    {
        $dto = $this->scientificWorkRequestFactory->makeDto();
        if ($this->scientificWorkForm->load($dto) && $this->scientificWorkForm->validate()) {
            $result = $this->scientificWorkAction->run($dto);
            return (new ScientificWorkTransformer($result))->makeResponse();
        }
        return $this->methodicalWorkForm;
    }

    public function actionMethodicalWork()
    {
        $dto = $this->methodicalWorkRequestFactory->makeDto();
        if ($this->methodicalWorkForm->load($dto) && $this->methodicalWorkForm->validate()) {
            $result = $this->methodicalWorkAction->run($dto);
            return (new MethodicalWorkTransformer($result))->makeResponse();
        }
        return $this->methodicalWorkForm;
    }
}
