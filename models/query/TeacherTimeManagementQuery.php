<?php declare(strict_types=1);

namespace models\query;

use models\TeacherTimeManagement;
use seog\db\ActiveQueryAdapter;

class TeacherTimeManagementQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherTimeManagement::class);
    }
}
