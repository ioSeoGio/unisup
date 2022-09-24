<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130200_journal_records_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_journal-record_index',
            'description' => 'app/journal-record/index'
        ],
        'view' => [
            'name' => 'app_journal-record_view',
            'description' => 'app/journal-record/view'
        ],
        'create' => [
            'name' => 'app_journal-record_create',
            'description' => 'app/journal-record/create'
        ],
        'update' => [
            'name' => 'app_journal-record_update',
            'description' => 'app/journal-record/update'
        ],
        'delete' => [
            'name' => 'app_journal-record_delete',
            'description' => 'app/journal-record/delete'
        ]
    ];

    public $roles = [
        'AppJournalRecordFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppJournalRecordView' => [
            'index',
            'view'
        ],
        'AppJournalRecordEdit' => [
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
            'roles' => ['AppJournalRecordFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppJournalRecordFull'],
            'rules' => [],
        ],
    ];
}
