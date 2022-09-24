<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\AcademicDegree;

class AcademicDegreeQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(AcademicDegree::class);
    }
}
