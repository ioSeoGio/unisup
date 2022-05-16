<?php

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130240_educational_work_reports_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_educational-work-report_index',
            'description' => 'app/educational-work-report/index'
        ],
        'view' => [
            'name' => 'app_educational-work-report_view',
            'description' => 'app/educational-work-report/view'
        ],
        'create' => [
            'name' => 'app_educational-work-report_create',
            'description' => 'app/educational-work-report/create'
        ],
        'update' => [
            'name' => 'app_educational-work-report_update',
            'description' => 'app/educational-work-report/update'
        ],
        'delete' => [
            'name' => 'app_educational-work-report_delete',
            'description' => 'app/educational-work-report/delete'
        ]
    ];

    public $roles = [
        'AppEducationalWorkReportFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppEducationalWorkReportView' => [
            'index',
            'view'
        ],
        'AppEducationalWorkReportEdit' => [
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
            'roles' => ['AppEducationalWorkReportFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppEducationalWorkReportFull'],
            'rules' => [],
        ],
    ];
}
