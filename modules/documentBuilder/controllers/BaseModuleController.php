<?php

namespace app\modules\documentBuilder\controllers;

use seog\rest\Controller;

class BaseModuleController extends Controller
{
    public function rules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['moderator'],
            ]
        ];
    }
}
