<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_disciplines_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_discipline_index',
            'description' => 'app/discipline/index'
        ],
        'view' => [
            'name' => 'app_discipline_view',
            'description' => 'app/discipline/view'
        ],
        'create' => [
            'name' => 'app_discipline_create',
            'description' => 'app/discipline/create'
        ],
        'update' => [
            'name' => 'app_discipline_update',
            'description' => 'app/discipline/update'
        ],
        'delete' => [
            'name' => 'app_discipline_delete',
            'description' => 'app/discipline/delete'
        ]
    ];

    public $roles = [
        'AppDisciplineFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppDisciplineView' => [
            'index',
            'view'
        ],
        'AppDisciplineEdit' => [
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
            'roles' => ['AppDisciplineFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppDisciplineFull'],
            'rules' => [],
        ],
    ];
}
