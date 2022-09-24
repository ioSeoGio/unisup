<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_groups_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_group_index',
            'description' => 'app/group/index'
        ],
        'view' => [
            'name' => 'app_group_view',
            'description' => 'app/group/view'
        ],
        'create' => [
            'name' => 'app_group_create',
            'description' => 'app/group/create'
        ],
        'update' => [
            'name' => 'app_group_update',
            'description' => 'app/group/update'
        ],
        'delete' => [
            'name' => 'app_group_delete',
            'description' => 'app/group/delete'
        ]
    ];

    public $roles = [
        'AppGroupFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppGroupView' => [
            'index',
            'view'
        ],
        'AppGroupEdit' => [
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
            'roles' => ['AppGroupFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppGroupFull'],
            'rules' => [],
        ],
    ];
}
