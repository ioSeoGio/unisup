<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Subgroup;

class SubgroupQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Subgroup::class);
    }
}
