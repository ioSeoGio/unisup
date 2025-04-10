<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Auditorium;

class AuditoriumQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Auditorium::class);
    }
}
