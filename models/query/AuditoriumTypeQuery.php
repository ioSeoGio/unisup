<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\AuditoriumType;

class AuditoriumTypeQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(AuditoriumType::class);
    }
}
