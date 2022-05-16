<?php

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_teachers_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_teacher_index',
            'description' => 'app/teacher/index'
        ],
        'view' => [
            'name' => 'app_teacher_view',
            'description' => 'app/teacher/view'
        ],
        'create' => [
            'name' => 'app_teacher_create',
            'description' => 'app/teacher/create'
        ],
        'update' => [
            'name' => 'app_teacher_update',
            'description' => 'app/teacher/update'
        ],
        'delete' => [
            'name' => 'app_teacher_delete',
            'description' => 'app/teacher/delete'
        ]
    ];

    public $roles = [
        'AppTeacherFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppTeacherView' => [
            'index',
            'view'
        ],
        'AppTeacherEdit' => [
            'update',
            'create',
            'delete'
        ]
    ];
    
    public $rules = [
    ];

    public $rolesAssignments = [
        Rbac::ADMIN => [
            'permissions' => [],
            'roles' => ['AppTeacherFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppTeacherFull'],
            'rules' => [],
        ],
    ];
}
