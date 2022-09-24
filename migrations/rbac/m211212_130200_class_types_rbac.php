<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_class_types_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_class-type_index',
            'description' => 'app/class-type/index'
        ],
        'view' => [
            'name' => 'app_class-type_view',
            'description' => 'app/class-type/view'
        ],
        'create' => [
            'name' => 'app_class-type_create',
            'description' => 'app/class-type/create'
        ],
        'update' => [
            'name' => 'app_class-type_update',
            'description' => 'app/class-type/update'
        ],
        'delete' => [
            'name' => 'app_class-type_delete',
            'description' => 'app/class-type/delete'
        ]
    ];
    
    public $roles = [
        'AppClassTypeFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppClassTypeView' => [
            'index',
            'view'
        ],
        'AppClassTypeEdit' => [
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
            'roles' => ['AppClassTypeFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppClassTypeFull'],
            'rules' => [],
        ],
    ];
}
