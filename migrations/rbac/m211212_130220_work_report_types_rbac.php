<?php declare(strict_types=1);

namespace app\migrations\rbac;

use app\rbac\Rbac;
use seog\db\RbacMigration;

class m211212_130220_work_report_types_rbac extends RbacMigration
{
    public $permissions = [
        'index' => [
            'name' => 'app_work-report-type_index',
            'description' => 'app/work-report-type/index'
        ],
        'view' => [
            'name' => 'app_work-report-type_view',
            'description' => 'app/work-report-type/view'
        ],
        'create' => [
            'name' => 'app_work-report-type_create',
            'description' => 'app/work-report-type/create'
        ],
        'update' => [
            'name' => 'app_work-report-type_update',
            'description' => 'app/work-report-type/update'
        ],
        'delete' => [
            'name' => 'app_work-report-type_delete',
            'description' => 'app/work-report-type/delete'
        ]
    ];

    public $roles = [
        'AppWorkReportTypeFull' => [
            'index',
            'view',
            'create',
            'update',
            'delete'
        ],
        'AppWorkReportTypeView' => [
            'index',
            'view'
        ],
        'AppWorkReportTypeEdit' => [
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
            'roles' => ['AppWorkReportTypeFull'],
            'rules' => [],
        ],
        Rbac::MODERATOR => [
            'permissions' => [],
            'roles' => ['AppWorkReportTypeFull'],
            'rules' => [],
        ],
    ];
}
