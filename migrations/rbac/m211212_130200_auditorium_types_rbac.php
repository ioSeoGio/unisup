<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_auditorium_types_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_auditorium-type_index',
            'description' => 'app/auditorium-type/index'
        ],
        'view' => [
            'name' => 'app_auditorium-type_view',
            'description' => 'app/auditorium-type/view'
        ],
        'create' => [
            'name' => 'app_auditorium-type_create',
            'description' => 'app/auditorium-type/create'
        ],
        'update' => [
            'name' => 'app_auditorium-type_update',
            'description' => 'app/auditorium-type/update'
        ],
        'delete' => [
            'name' => 'app_auditorium-type_delete',
            'description' => 'app/auditorium-type/delete'
        ]
    ];
    
    public $roles = [
        'AppAuditoriumTypeFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppAuditoriumTypeView' => [
            'index',
            'view'
        ],
        'AppAuditoriumTypeEdit' => [
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
            'roles' => ['AppAuditoriumTypeFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppAuditoriumTypeFull'],
            'rules' => [],
        ],
    ];
}
