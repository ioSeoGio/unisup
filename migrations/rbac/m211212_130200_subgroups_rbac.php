<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_subgroups_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_subgroup_index',
            'description' => 'app/subgroup/index'
        ],
        'view' => [
            'name' => 'app_subgroup_view',
            'description' => 'app/subgroup/view'
        ],
        'create' => [
            'name' => 'app_subgroup_create',
            'description' => 'app/subgroup/create'
        ],
        'update' => [
            'name' => 'app_subgroup_update',
            'description' => 'app/subgroup/update'
        ],
        'delete' => [
            'name' => 'app_subgroup_delete',
            'description' => 'app/subgroup/delete'
        ]
    ];

    public $roles = [
        'AppSubgroupFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppSubgroupView' => [
            'index',
            'view'
        ],
        'AppSubgroupEdit' => [
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
            'roles' => ['AppSubgroupFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppSubgroupFull'],
            'rules' => [],
        ],
    ];
}
