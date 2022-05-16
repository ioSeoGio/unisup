<?php

namespace app\modules\documentBuilder\controllers;

use yii\filters\VerbFilter;

use domain\educationalWork\EducationalWorkRequestFactory;
use domain\educationalWork\EducationalWorkForm;
use domain\educationalWork\EducationalWorkAction;
use domain\educationalWork\EducationalWorkTransformer;

class SiteController extends BaseModuleController
{
    public function __construct(
        $id, 
        $module, 

        private EducationalWorkRequestFactory $educationalWorkRequestFactory,
        private EducationalWorkForm $educationalWorkForm,
        private EducationalWorkAction $educationalWorkAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function rules()
    {
        return array_merge_recursive(parent::rules(), [
            [
                'actions' => ['educational-work'],
                'allow' => true,
            ]
        ]);
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => [],
            'except' => ['educational-work'],
        ]);
    }

    public function verbs()
    {
        return [
            'class' => VerbFilter::className(),
            'actions' => [
                'educational-work' => ['get'],
            ],
        ];
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
}
