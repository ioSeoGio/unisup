<?php

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_courses_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_course_index',
            'description' => 'app/course/index'
        ],
        'view' => [
            'name' => 'app_course_view',
            'description' => 'app/course/view'
        ],
        'create' => [
            'name' => 'app_course_create',
            'description' => 'app/course/create'
        ],
        'update' => [
            'name' => 'app_course_update',
            'description' => 'app/course/update'
        ],
        'delete' => [
            'name' => 'app_course_delete',
            'description' => 'app/course/delete'
        ]
    ];
    
    public $roles = [
        'AppCourseFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppCourseView' => [
            'index',
            'view'
        ],
        'AppCourseEdit' => [
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
            'roles' => ['AppCourseFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppCourseFull'],
            'rules' => [],
        ],
    ];
}
