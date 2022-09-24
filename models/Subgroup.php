<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Subgroup extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%subgroups}}';
    }

    public function getDiscipline(): ActiveQueryInterface
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    public function getGroup(): ActiveQueryInterface
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
