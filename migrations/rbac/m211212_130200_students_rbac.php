<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_students_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_student_index',
            'description' => 'app/student/index'
        ],
        'view' => [
            'name' => 'app_student_view',
            'description' => 'app/student/view'
        ],
        'create' => [
            'name' => 'app_student_create',
            'description' => 'app/student/create'
        ],
        'update' => [
            'name' => 'app_student_update',
            'description' => 'app/student/update'
        ],
        'delete' => [
            'name' => 'app_student_delete',
            'description' => 'app/student/delete'
        ]
    ];

    public $roles = [
        'AppStudentFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppStudentView' => [
            'index',
            'view'
        ],
        'AppStudentEdit' => [
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
            'roles' => ['AppStudentFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppStudentFull'],
            'rules' => [],
        ],
    ];
}
