<?php

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_specialties_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_specialty_index',
            'description' => 'app/specialty/index'
        ],
        'view' => [
            'name' => 'app_specialty_view',
            'description' => 'app/specialty/view'
        ],
        'create' => [
            'name' => 'app_specialty_create',
            'description' => 'app/specialty/create'
        ],
        'update' => [
            'name' => 'app_specialty_update',
            'description' => 'app/specialty/update'
        ],
        'delete' => [
            'name' => 'app_specialty_delete',
            'description' => 'app/specialty/delete'
        ]
    ];

    public $roles = [
        'AppSpecialtyFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppSpecialtyView' => [
            'index',
            'view'
        ],
        'AppSpecialtyEdit' => [
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
            'roles' => ['AppSpecialtyFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppSpecialtyFull'],
            'rules' => [],
        ],
    ];
}
