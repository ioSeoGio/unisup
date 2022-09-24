<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_teacher_posts_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_teacher-post_index',
            'description' => 'app/teacher-post/index'
        ],
        'view' => [
            'name' => 'app_teacher-post_view',
            'description' => 'app/teacher-post/view'
        ],
        'create' => [
            'name' => 'app_teacher-post_create',
            'description' => 'app/teacher-post/create'
        ],
        'update' => [
            'name' => 'app_teacher-post_update',
            'description' => 'app/teacher-post/update'
        ],
        'delete' => [
            'name' => 'app_teacher-post_delete',
            'description' => 'app/teacher-post/delete'
        ]
    ];

    public $roles = [
        'AppTeacherPostFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppTeacherPostView' => [
            'index',
            'view'
        ],
        'AppTeacherPostEdit' => [
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
            'roles' => ['AppTeacherPostFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppTeacherPostFull'],
            'rules' => [],
        ],
    ];
}
