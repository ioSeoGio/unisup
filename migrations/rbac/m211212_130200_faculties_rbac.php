<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_faculties_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_faculty_index',
            'description' => 'app/faculty/index'
        ],
        'view' => [
            'name' => 'app_faculty_view',
            'description' => 'app/faculty/view'
        ],
        'create' => [
            'name' => 'app_faculty_create',
            'description' => 'app/faculty/create'
        ],
        'update' => [
            'name' => 'app_faculty_update',
            'description' => 'app/faculty/update'
        ],
        'delete' => [
            'name' => 'app_faculty_delete',
            'description' => 'app/faculty/delete'
        ]
    ];

    public $roles = [
        'AppFacultyFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppFacultyView' => [
            'index',
            'view'
        ],
        'AppFacultyEdit' => [
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
            'roles' => ['AppFacultyFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppFacultyFull'],
            'rules' => [],
        ],
    ];
}
