<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;


class ImperaviFileController extends \yii\rest\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'images-get', 'image-upload', 'image-delete', 'files-get', 'file-upload', 'file-delete'],
                        'allow' => true,
                        'roles' => ['moderator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        $imgAbsoluteUrl = Url::toRoute(['/loaded/imperavi/images', 'language' => '']);
        $imgPath = Yii::getAlias('@webroot/loaded/imperavi/images');
        
        $fileAbsoluteUrl = Url::toRoute(['/loaded/imperavi/files', 'language' => '']);
        $filePath = Yii::getAlias('@webroot/loaded/imperavi/files');
        
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'path' => $imgPath,
                'url' => $imgAbsoluteUrl,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'path' => $imgPath,
                'url' => $imgAbsoluteUrl,
            ],
            'image-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'path' => $imgPath,
                'url' => $imgAbsoluteUrl,
            ],


            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'path' => $filePath,
                'url' => $fileAbsoluteUrl,
                'uploadOnlyImage' => false,
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'path' => $filePath,
                'url' => $fileAbsoluteUrl,
                'options' => ['only' => ['*.*']],
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'path' => $filePath,
                'url' => $fileAbsoluteUrl,
            ],
        ];
    }

}
