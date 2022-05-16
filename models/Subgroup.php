<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Subgroup extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%subgroups}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
