<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Discipline extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%disciplines}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'name_in_short'], 'string', 'max' => 255]
        ];
    }

    public function getSubgroups(): ActiveQueryInterface
    {
        return $this->hasMany(Subgroup::class, ['discipline_id' => 'id']);
    }

    public function getJournals(): ActiveQueryInterface
    {
        return $this->hasMany(Journal::class, ['discipline_id' => 'id']);
    }

    public function getTeacherPreferences(): ActiveQueryInterface
    {
        return $this->hasMany(TeacherPreference::class, ['discipline_id' => 'id']);
    }

    public function getDisciplineTime(): ActiveQueryInterface
    {
        return $this->hasMany(DisciplineTime::class, ['discipline_id' => 'id']);
    }
}
