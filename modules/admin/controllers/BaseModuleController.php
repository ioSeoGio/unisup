<?php

namespace app\modules\admin\controllers;

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
