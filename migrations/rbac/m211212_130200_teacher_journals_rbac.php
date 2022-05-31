<?php

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_teacher_journals_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_teacher-journal_index',
            'description' => 'app/teacher-journal/index'
        ],
        'view' => [
            'name' => 'app_teacher-journal_view',
            'description' => 'app/teacher-journal/view'
        ],
        'create' => [
            'name' => 'app_teacher-journal_create',
            'description' => 'app/teacher-journal/create'
        ],
        'update' => [
            'name' => 'app_teacher-journal_update',
            'description' => 'app/teacher-journal/update'
        ],
        'delete' => [
            'name' => 'app_teacher-journal_delete',
            'description' => 'app/teacher-journal/delete'
        ]
    ];

    public $roles = [
        'AppJournalFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppJournalView' => [
            'index',
            'view'
        ],
        'AppJournalEdit' => [
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
            'roles' => ['AppJournalFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppJournalFull'],
            'rules' => [],
        ],
    ];
}
