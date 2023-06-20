<?php

namespace app\modules\documentBuilder\controllers;

use factories\RequestFactory;
use OpenApi\Annotations as OA;
use Yii;
use yii\filters\VerbFilter;

use domain\workReport\educationalWork\RequestDto as EducationalWorkRequestDto;
use domain\workReport\educationalWork\Form as EducationalWorkForm;
use domain\workReport\educationalWork\Action as EducationalWorkAction;
use domain\workReport\educationalWork\Transformer as EducationalWorkTransformer;

use domain\workReport\scientificWork\RequestDto as ScientificWorkFormRequestDto;
use domain\workReport\scientificWork\Form as ScientificWorkForm;
use domain\workReport\scientificWork\Action as ScientificWorkAction;
use domain\workReport\scientificWork\Transformer as ScientificWorkTransformer;

use domain\workReport\methodicalWork\RequestDto as MethodicalWorkRequestDto;
use domain\workReport\methodicalWork\Form as MethodicalWorkForm;
use domain\workReport\methodicalWork\Action as MethodicalWorkAction;
use domain\workReport\methodicalWork\Transformer as MethodicalWorkTransformer;

class SiteController extends BaseModuleController
{
    public function __construct(
        $id, 
        $module, 

        private RequestFactory $requestFactory,

        private EducationalWorkForm $educationalWorkForm,
        private EducationalWorkAction $educationalWorkAction,

        private ScientificWorkForm $scientificWorkForm,
        private ScientificWorkAction $scientificWorkAction,

        private MethodicalWorkForm $methodicalWorkForm,
        private MethodicalWorkAction $methodicalWorkAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function rules(): array
    {
        return array_merge_recursive(parent::rules(), [
            [
                'actions' => ['educational-work', 'scientific-work', 'methodical-work'],
                'allow' => true,
            ]
        ]);
    }

    protected function auth(): array
    {
        return array_merge_recursive(parent::auth(), [
            'only' => [],
            'except' => ['educational-work', 'scientific-work', 'methodical-work'],
        ]);
    }

    public function verbActions(): array
    {
        return array_merge(parent::verbActions(), [
            'educational-work' => ['post', 'options'],
            'scientific-work' => ['post', 'options'],
            'methodical-work' => ['post', 'options'],
        ]);
    }

    /**
     * @OA\Post(
     *     path="/document-builder/site/educational-work",
     *     @OA\Response(response="200", description="Документ по образовательной работе")
     * )
     */
    public function actionEducationalWork()
    {
        $dto = new EducationalWorkRequestDto();
        $dto->documentHeaderString = Yii::$app->request->get('document_header');
        $dto->teacherId = Yii::$app->request->get('teacher_id');

        $result = $this->educationalWorkAction->run($dto);
        return (new EducationalWorkTransformer($result))->makeResponse();
    }

    public function actionScientificWork()
    {
        $dto = new ScientificWorkFormRequestDto();
        $dto->documentHeaderString = Yii::$app->request->get('document_header');
        $dto->teacherId = Yii::$app->request->get('teacher_id');

        $result = $this->scientificWorkAction->run($dto);
        return (new ScientificWorkTransformer($result))->makeResponse();
    }

    public function actionMethodicalWork()
    {
        $dto = new MethodicalWorkRequestDto();
        $dto->documentHeaderString = Yii::$app->request->get('document_header');
        $dto->teacherId = Yii::$app->request->get('teacher_id');

        $result = $this->methodicalWorkAction->run($dto);
        return (new MethodicalWorkTransformer($result))->makeResponse();
    }
}
