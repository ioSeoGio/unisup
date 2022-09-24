<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_academic_degrees_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_academic-degree_index',
            'description' => 'app/academic-degree/index'
        ],
        'view' => [
            'name' => 'app_academic-degree_view',
            'description' => 'app/academic-degree/view'
        ],
        'create' => [
            'name' => 'app_academic-degree_create',
            'description' => 'app/academic-degree/create'
        ],
        'update' => [
            'name' => 'app_academic-degree_update',
            'description' => 'app/academic-degree/update'
        ],
        'delete' => [
            'name' => 'app_academic-degree_delete',
            'description' => 'app/academic-degree/delete'
        ]
    ];
    
    public $roles = [
        'AppAcademicDegreeFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppAcademicDegreeView' => [
            'index',
            'view'
        ],
        'AppAcademicDegreeEdit' => [
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
            'roles' => ['AppAcademicDegreeFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppAcademicDegreeFull'],
            'rules' => [],
        ],
    ];
}
