<?php declare(strict_types=1);

namespace domain\teacherPreference\writeAll;

class Dto
{
    public int $teacherId;
    public int $disciplineId;
    public int $semesterId;
    public float $importanceCoefficient;
}
