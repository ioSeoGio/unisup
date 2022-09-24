<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_teacher_preferences_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_teacher-preference_index',
            'description' => 'app/teacher-preference/index'
        ],
        'view' => [
            'name' => 'app_teacher-preference_view',
            'description' => 'app/teacher-preference/view'
        ],
        'create' => [
            'name' => 'app_teacher-preference_create',
            'description' => 'app/teacher-preference/create'
        ],
        'update' => [
            'name' => 'app_teacher-preference_update',
            'description' => 'app/teacher-preference/update'
        ],
        'delete' => [
            'name' => 'app_teacher-preference_delete',
            'description' => 'app/teacher-preference/delete'
        ]
    ];

    public $roles = [
        'AppTeacherPreferenceFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppTeacherPreferenceView' => [
            'index',
            'view'
        ],
        'AppTeacherPreferenceEdit' => [
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
            'roles' => ['AppTeacherPreferenceFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppTeacherPreferenceFull'],
            'rules' => [],
        ],
    ];
}
