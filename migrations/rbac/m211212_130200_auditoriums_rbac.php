<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_auditoriums_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_auditorium_index',
            'description' => 'app/auditorium/index'
        ],
        'view' => [
            'name' => 'app_auditorium_view',
            'description' => 'app/auditorium/view'
        ],
        'create' => [
            'name' => 'app_auditorium_create',
            'description' => 'app/auditorium/create'
        ],
        'update' => [
            'name' => 'app_auditorium_update',
            'description' => 'app/auditorium/update'
        ],
        'delete' => [
            'name' => 'app_auditorium_delete',
            'description' => 'app/auditorium/delete'
        ]
    ];
    
    public $roles = [
        'AppAuditoriumFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppAuditoriumView' => [
            'index',
            'view'
        ],
        'AppAuditoriumEdit' => [
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
            'roles' => ['AppAuditoriumFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppAuditoriumFull'],
            'rules' => [],
        ],
    ];
}
