<?php

namespace app\modules\documentBuilder\controllers;

use seog\rest\Controller;

abstract class BaseModuleController extends Controller
{
    public function rules(): array
    {
        return [
            [
                'allow' => true,
                // 'roles' => ['moderator'],
            ]
        ];
    }
}
