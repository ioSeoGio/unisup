<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_departments_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_department_index',
            'description' => 'app/department/index'
        ],
        'view' => [
            'name' => 'app_department_view',
            'description' => 'app/department/view'
        ],
        'create' => [
            'name' => 'app_department_create',
            'description' => 'app/department/create'
        ],
        'update' => [
            'name' => 'app_department_update',
            'description' => 'app/department/update'
        ],
        'delete' => [
            'name' => 'app_department_delete',
            'description' => 'app/department/delete'
        ]
    ];
    
    public $roles = [
        'AppDepartmentFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppDepartmentView' => [
            'index',
            'view'
        ],
        'AppDepartmentEdit' => [
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
            'roles' => ['AppDepartmentFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppDepartmentFull'],
            'rules' => [],
        ],
    ];
}
