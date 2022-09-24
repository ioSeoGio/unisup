<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_academic_titles_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_academic-title_index',
            'description' => 'app/academic-title/index'
        ],
        'view' => [
            'name' => 'app_academic-title_view',
            'description' => 'app/academic-title/view'
        ],
        'create' => [
            'name' => 'app_academic-title_create',
            'description' => 'app/academic-title/create'
        ],
        'update' => [
            'name' => 'app_academic-title_update',
            'description' => 'app/academic-title/update'
        ],
        'delete' => [
            'name' => 'app_academic-title_delete',
            'description' => 'app/academic-title/delete'
        ]
    ];
    
    public $roles = [
        'AppAcademicTitleFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppAcademicTitleView' => [
            'index',
            'view'
        ],
        'AppAcademicTitleEdit' => [
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
            'roles' => ['AppAcademicTitleFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppAcademicTitleFull'],
            'rules' => [],
        ],
    ];
}
